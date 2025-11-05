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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pemberi testimoni
            $table->text('quote');  // Isi kutipan/testimoni
            $table->string('avatar')->nullable(); // Foto/avatar (Opsional)
            $table->string('role')->nullable();   // Pekerjaan/jabatan, misal "Food Blogger" (Opsional)
            
            // Rating 1-5 bintang (Opsional)
            $table->tinyInteger('rating')->nullable(); 

            // Tombol untuk menampilkan/menyembunyikan testimoni
            $table->boolean('is_visible')->default(true); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};