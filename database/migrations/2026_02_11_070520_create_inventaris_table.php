<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item');
            $table->enum('jenis', ['peralatan utama', 'peralatan pendukung']);
            $table->integer('jumlah'); // satuan pcs
            $table->enum('status', ['bagus', 'rusak', 'hilang']);
            $table->date('tanggal_diperoleh');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
