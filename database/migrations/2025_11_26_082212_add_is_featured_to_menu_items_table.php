<?php
// database/migrations/YYYY_MM_DD_HHMMSS_add_is_featured_to_menu_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            // Tambahkan kolom boolean is_featured dengan nilai default false
            $table->boolean('is_featured')->default(false)->after('price'); // Letakkan setelah kolom 'price'
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
