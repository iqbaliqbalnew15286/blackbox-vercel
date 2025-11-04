<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promo_items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Promo
            $table->text('description')->nullable(); // Deskripsi
            $table->string('image')->nullable(); // Gambar/Banner Promo
            $table->string('code')->nullable()->unique(); // Kode Promo (opsional, harus unik)
            
            // Tipe diskon: 'percent' (persen) atau 'fixed' (potongan tetap)
            $table->string('discount_type')->default('percent'); 
            $table->decimal('discount_value', 10, 2); // Nilai diskon

            $table->date('start_date'); // Tanggal mulai valid
            $table->date('end_date'); // Tanggal berakhir valid

            $table->boolean('is_active')->default(true); // Status promo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_items');
    }
};