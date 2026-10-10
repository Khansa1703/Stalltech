<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\BomSpreadsheetImporter;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('bom:import {path}', function (string $path) {
    $result = app(BomSpreadsheetImporter::class)->import($path);
    $this->info("Produk BOM: {$result['products']}");
    $this->info("Variasi BOM: {$result['variants']}");
    $this->info("Komponen BOM: {$result['bomItems']}");
})->purpose('Import BOM CHMP dari file Excel Stalltech');
