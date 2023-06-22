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
        Schema::create('istris', function (Blueprint $table) {
            $table->id();
            $table->String("nik");
            $table->String("nama");
            $table->String("tgl_lahir");
            $table->String("tempat_lahir");
            $table->String("status_nikah");
            $table->String("pekerjaan");
            $table->String("alamat");
            $table->String("kewarganegaraan");
            $table->String("umur");
            $table->String("agama");
            $table->String("foto_ktp");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('istri');
    }
};
