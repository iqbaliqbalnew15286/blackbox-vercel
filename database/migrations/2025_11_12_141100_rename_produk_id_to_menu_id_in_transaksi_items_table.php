<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan perubahan.
     */
    public function up(): void
    {
        Schema::table('transaksi_items', function (Blueprint $table) {
            // Ganti nama kolom produk_id menjadi menu_id
            $table->renameColumn('produk_id', 'menu_id');
        });
    }

    /**
     * Batalkan perubahan.
     */
    public function down(): void
    {
        Schema::table('transaksi_items', function (Blueprint $table) {
            // Balik lagi ke nama semula kalau rollback
            $table->renameColumn('menu_id', 'produk_id');
        });
    }
};
