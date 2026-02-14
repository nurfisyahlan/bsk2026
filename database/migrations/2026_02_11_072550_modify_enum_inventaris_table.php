<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE inventaris 
            MODIFY jenis ENUM('Peralatan Utama','Peralatan Pendukung')");

        DB::statement("ALTER TABLE inventaris 
            MODIFY status ENUM('Bagus','Rusak','Hilang')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE inventaris 
            MODIFY jenis ENUM('peralatan utama','peralatan pendukung')");

        DB::statement("ALTER TABLE inventaris 
            MODIFY status ENUM('bagus','rusak')");
    }
};
