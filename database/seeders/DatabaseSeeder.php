<?php

namespace Database\Seeders;

use App\Models\Bom;
use App\Models\Material;
use App\Models\MotorcycleType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'owner@stalltech.test'], ['name' => 'Owner Stalltech', 'phone' => '08123456789', 'address' => 'Workshop Stalltech', 'role' => 'owner', 'password' => 'password']);
        User::updateOrCreate(['email' => 'customer@stalltech.test'], ['name' => 'Customer Demo', 'phone' => '081298765432', 'address' => 'Jl. Merdeka No. 10, Jakarta', 'role' => 'customer', 'password' => 'password']);

        $types = collect([
            ['name' => 'Honda Beat', 'size' => 'Standar'],
            ['name' => 'Motor Bebek', 'size' => 'Standar'],
            ['name' => 'Honda CBR', 'size' => 'Standar'],
            ['name' => 'Honda CB150R', 'size' => 'Standar'],
            ['name' => 'Honda Vario', 'size' => 'Standar'],
            ['name' => 'Yamaha Aerox', 'size' => 'Jumbo'],
            ['name' => 'Yamaha NMAX', 'size' => 'Jumbo'],
            ['name' => 'Honda PCX', 'size' => 'Jumbo'],
            ['name' => 'Honda ADV', 'size' => 'Jumbo'],
            ['name' => 'Yamaha XMAX', 'size' => 'Jumbo'],
        ])->mapWithKeys(fn ($type) => [$type['name'] => MotorcycleType::updateOrCreate(['name' => $type['name']], $type)]);

        $materials = collect([
            ['name' => 'Kulit sintetis hitam', 'unit' => 'meter', 'current_stock' => 48, 'minimum_stock' => 10, 'material_cost' => 85000],
            ['name' => 'Busa jok premium', 'unit' => 'lembar', 'current_stock' => 24, 'minimum_stock' => 6, 'material_cost' => 120000],
            ['name' => 'Benang nilon', 'unit' => 'roll', 'current_stock' => 15, 'minimum_stock' => 3, 'material_cost' => 35000],
        ])->mapWithKeys(fn ($material) => [$material['name'] => Material::updateOrCreate(['name' => $material['name']], $material)]);

        $motorcycleGroups = [
            'Standar' => ['Honda Beat', 'Motor Bebek', 'Honda CBR', 'Honda CB150R', 'Honda Vario'],
            'Jumbo' => ['Yamaha Aerox', 'Yamaha NMAX', 'Honda PCX', 'Honda ADV', 'Yamaha XMAX'],
        ];
        $products = [
            ['name' => 'Urban Grip', 'description' => 'Jok harian dengan tekstur grip yang stabil untuk mobilitas kota.', 'size' => 'Standar', 'price' => 475000, 'stock' => 12],
            ['name' => 'Touring Wide', 'description' => 'Duduk lebih lebar dan suportif untuk perjalanan jauh.', 'size' => 'Jumbo', 'price' => 675000, 'stock' => 8],
            ['name' => 'Daily Comfort', 'description' => 'Profil ergonomis untuk pemakaian harian yang ringan.', 'size' => 'Standar', 'price' => 525000, 'stock' => 10],
        ];
        foreach ($products as $data) {
            $product = Product::updateOrCreate(['name' => $data['name']], ['description' => $data['description'], 'is_active' => true]);
            foreach ($motorcycleGroups[$data['size']] as $typeName) {
                $variant = $product->variants()->updateOrCreate(['motorcycle_type_id' => $types[$typeName]->id], ['name' => $data['name'] . ' ' . $data['size'], 'size' => $data['size'], 'price' => $data['price'], 'stock' => $data['stock']]);
                $bom = Bom::firstOrCreate(['product_variant_id' => $variant->id]);
                $bom->items()->updateOrCreate(['material_id' => $materials['Kulit sintetis hitam']->id], ['quantity' => $data['size'] === 'Jumbo' ? 2.5 : 2, 'unit' => 'meter', 'material_cost' => $materials['Kulit sintetis hitam']->material_cost]);
                $bom->items()->updateOrCreate(['material_id' => $materials['Busa jok premium']->id], ['quantity' => 1, 'unit' => 'lembar', 'material_cost' => $materials['Busa jok premium']->material_cost]);
                $bom->items()->updateOrCreate(['material_id' => $materials['Benang nilon']->id], ['quantity' => .25, 'unit' => 'roll', 'material_cost' => $materials['Benang nilon']->material_cost]);
            }
        }
    }
}
