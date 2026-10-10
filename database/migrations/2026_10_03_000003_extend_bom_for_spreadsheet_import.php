<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->string('code')->nullable()->unique()->after('id');
        });

        Schema::table('bom_items', function (Blueprint $table) {
            $table->dropForeign(['material_id']);
            $table->foreignId('material_id')->nullable()->change();
            $table->string('item_type')->default('material')->after('bom_id');
            $table->string('item_name')->nullable()->after('material_id');
        });
    }

    public function down(): void
    {
        DB::table('bom_items')->where('item_type', 'service')->delete();
        Schema::table('bom_items', function (Blueprint $table) {
            $table->dropColumn(['item_type', 'item_name']);
            $table->foreignId('material_id')->nullable(false)->change();
            $table->foreign('material_id')->references('id')->on('materials')->restrictOnDelete();
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->dropColumn('code');
        });
    }
};
