<?php

namespace App\Services;

use App\Models\Bom;
use App\Models\Material;
use App\Models\MotorcycleType;
use App\Models\Product;
use Illuminate\Support\Str;
use RuntimeException;
use ZipArchive;

class BomSpreadsheetImporter
{
    public function import(string $path): array
    {
        if (! is_file($path)) {
            throw new RuntimeException("File BOM tidak ditemukan: {$path}");
        }

        $zip = new ZipArchive();
        if ($zip->open($path) !== true) {
            throw new RuntimeException('File BOM tidak dapat dibuka.');
        }

        $strings = $this->sharedStrings($zip);
        $rows = $this->sheetRows($zip, 'xl/worksheets/sheet1.xml', $strings);
        $zip->close();

        $groups = MotorcycleType::query()->get()->groupBy('size');
        $parentRows = collect($rows)->filter(fn (array $row) => ($row['A'] ?? null) === '0' && Str::contains($row['C'] ?? '', 'CHMP'));
        $products = 0;
        $variants = 0;
        $bomItems = 0;

        foreach ($parentRows as $rowNumber => $parent) {
            $size = Str::contains(Str::lower($parent['C'] ?? ''), 'jumbo') ? 'Jumbo' : 'Standar';
            $sourceName = trim((string) ($parent['C'] ?? 'Komponen CHMP'));
            $productName = trim(explode(' - ', $sourceName, 2)[0]);
            $product = Product::updateOrCreate(
                ['name' => $productName],
                ['description' => 'Data BOM CHMP diimpor dari spreadsheet produksi.', 'is_active' => false]
            );
            $products++;

            $children = collect($rows)->filter(function (array $row, int $number) use ($rowNumber) {
                return $number > $rowNumber && $number < $rowNumber + 3 && ($row['A'] ?? null) === '1';
            });

            foreach ($groups->get($size, collect()) as $motorcycleType) {
                $variant = $product->variants()->updateOrCreate(
                    ['motorcycle_type_id' => $motorcycleType->id],
                    [
                        'name' => $sourceName,
                        'size' => $size,
                        'price' => (int) round((float) ($parent['K'] ?? 0)),
                        'stock' => 0,
                    ]
                );
                $variants++;
                $bom = Bom::firstOrCreate(['product_variant_id' => $variant->id]);

                foreach ($children as $child) {
                    $quantity = (float) ($child['I'] ?? $child['F'] ?? 0);
                    $unit = trim((string) ($child['G'] ?? 'unit')) ?: 'unit';
                    $cost = (int) round((float) ($child['J'] ?? $child['K'] ?? 0));
                    $isService = Str::contains(Str::lower(($child['B'] ?? '') . ' ' . ($child['D'] ?? '') . ' ' . ($child['C'] ?? '')), 'jasa');

                    if ($isService) {
                        $bom->items()->updateOrCreate(
                            ['item_type' => 'service', 'item_name' => (string) ($child['C'] ?? 'Jasa Potong')],
                            ['material_id' => null, 'quantity' => $quantity, 'unit' => $unit, 'material_cost' => $cost]
                        );
                    } else {
                        $code = trim((string) ($child['B'] ?? '')) ?: null;
                        $material = Material::firstOrCreate(
                            ['code' => $code],
                            ['name' => $child['C'] ?? 'Material BOM', 'unit' => $unit, 'current_stock' => 0, 'minimum_stock' => 0, 'material_cost' => $cost]
                        );
                        $material->update(['name' => $child['C'] ?? $material->name, 'unit' => $unit, 'material_cost' => $cost]);
                        $bom->items()->updateOrCreate(
                            ['item_type' => 'material', 'material_id' => $material->id],
                            ['item_name' => null, 'quantity' => $quantity, 'unit' => $unit, 'material_cost' => $cost]
                        );
                    }
                    $bomItems++;
                }
            }
        }

        return compact('products', 'variants', 'bomItems');
    }

    private function sharedStrings(ZipArchive $zip): array
    {
        $xml = simplexml_load_string($zip->getFromName('xl/sharedStrings.xml'));
        $xml->registerXPathNamespace('x', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
        $strings = [];
        foreach ($xml->xpath('//x:si') as $item) {
            $item->registerXPathNamespace('x', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
            $parts = [];
            foreach ($item->xpath('.//x:t') as $text) $parts[] = (string) $text;
            $strings[] = implode('', $parts);
        }
        return $strings;
    }

    private function sheetRows(ZipArchive $zip, string $sheet, array $strings): array
    {
        $xml = simplexml_load_string($zip->getFromName($sheet));
        $xml->registerXPathNamespace('x', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
        $rows = [];
        foreach ($xml->xpath('//x:sheetData/x:row') as $row) {
            $values = [];
            foreach ($row->c as $cell) {
                $column = preg_replace('/[0-9]/', '', (string) $cell['r']);
                $value = (string) $cell->v;
                if ((string) $cell['t'] === 's') $value = $strings[(int) $value] ?? $value;
                $values[$column] = $value;
            }
            $rows[(int) $row['r']] = $values;
        }
        return $rows;
    }
}
