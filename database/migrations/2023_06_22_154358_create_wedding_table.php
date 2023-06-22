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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_suamis");
            $table->unsignedBigInteger("id_istris");
            $table->String("nikah_di");
            $table->String("jam_akad");
            $table->String("alamat_lokasi")->nullable();
            $table->foreign('id_suamis')->references('id')->on('suamis');
            $table->foreign('id_istris')->references('id')->on('istris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding');
    }
};
