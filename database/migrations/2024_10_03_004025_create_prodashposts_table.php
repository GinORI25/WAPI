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
        Schema::create('prodashposts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_project');
            $table->string('no_handphone');
            $table->string('username');
            $table->string('password');
            $table->string('facebook');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodashposts');
    }
};
