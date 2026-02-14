<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iuran', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');

            $table->string('no_bsk');
            $table->year('tahun');

            $table->enum('status', ['belum_lunas', 'sudah_lunas'])
                  ->default('belum_lunas');

            $table->timestamps();

            // relasi ke keluarga
            $table->foreign('no_bsk')
                  ->references('no_bsk')
                  ->on('keluarga')
                  ->onDelete('cascade');

            // 1 keluarga hanya 1 iuran per tahun
            $table->unique(['no_bsk', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iuran');
    }
};
