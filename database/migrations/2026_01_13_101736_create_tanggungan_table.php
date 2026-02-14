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
        Schema::create('tanggungan', function (Blueprint $table) {
            $table->id();
            $table->string('no_bsk'); //FK ke keluarga
            $table->string('nama_tanggungan');
            $table->enum('hubungan', ['Kepala Keluarga', 'Istri', 'Anak', 'Adik', 'Orang Tua', 'Lainnya']);
            $table->timestamps();

            $table->foreign('no_bsk')
                ->references('no_bsk')
                ->on('keluarga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggungan');
    }
};
