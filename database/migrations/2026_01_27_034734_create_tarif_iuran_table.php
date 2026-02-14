<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarif_iuran', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_mulai'); // tarif berlaku mulai tahun ini
            $table->integer('nominal');  // nominal per bulan
            $table->timestamps();

            // cegah duplikasi tarif di tahun yang sama
            $table->unique('tahun_mulai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarif_iuran');
    }
};
