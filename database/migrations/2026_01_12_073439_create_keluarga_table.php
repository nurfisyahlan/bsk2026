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
        Schema::create('keluarga', function (Blueprint $table) {
            $table->string('no_bsk')->primary();
            $table->string('nama_kk');
            $table->string('alamat');
            $table->enum('rt_rw',[
                'RT 01/RW 04',
                'RT 02/RW 04',
                'RT 03/RW 04',
                'RT 03/RW 03',
                'RW 05 PB',
                'RT/RW Luar'
            ]);
            $table->enum('status', ['Aktif','Nonaktif'])->default('Aktif');     
            $table->text('keterangan')->nullable();
            $table->string('jiwa'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
