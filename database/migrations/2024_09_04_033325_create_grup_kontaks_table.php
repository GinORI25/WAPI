<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupKontaksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grup_kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_grup');
            $table->integer('jumlah_kontak')->default(0);
            $table->timestamps();
        });

        Schema::create('grup_kontak_list_kontak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grup_kontak_id')->constrained()->onDelete('cascade');
            $table->foreignId('list_kontak_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_kontak_list_kontak');
        Schema::dropIfExists('grup_kontaks');
    }
}
