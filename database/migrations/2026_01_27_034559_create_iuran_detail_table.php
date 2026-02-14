<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iuran_detail', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('iuran_id');

            $table->enum('bulan', [
                'januari',
                'februari',
                'maret',
                'april',
                'mei',
                'juni',
                'juli',
                'agustus',
                'september',
                'oktober',
                'november',
                'desember'
            ]);

            $table->date('tanggal_bayar');
            $table->integer('nominal');

            $table->timestamps();

            // relasi ke iuran
            $table->foreign('iuran_id')
                  ->references('id')
                  ->on('iuran')
                  ->onDelete('cascade');

            // cegah bayar bulan yang sama 2x
            $table->unique(['iuran_id', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iuran_detail');
    }
};
