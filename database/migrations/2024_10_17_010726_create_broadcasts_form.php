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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->string('bcname', 300);  // Nama broadcast
            $table->json('kontak');         // Menyimpan banyak kontak dalam format JSON
            $table->timestamp('waktu')->nullable(); // Jadwal bisa nullable
            $table->text('message');        // Pesan broadcast
            $table->boolean('showButton');  // Apakah tombol akan ditampilkan
            $table->string('buttonText', 255)->nullable(); // Teks tombol, nullable
            $table->string('buttonUrl', 255)->nullable();  // URL tombol, nullable
            $table->string('namaButton', 255)->nullable(); // Nama tombol, nullable
            $table->string('image', 255)->nullable();      // Gambar, nullable
            $table->timestamps();           // Otomatis menambahkan `created_at` dan `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
