<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaksi_items', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->foreign('produk_id')->references('id')->on('menu_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_items', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->foreign('produk_id')->references('id')->on('produk');
        });
    }
};
