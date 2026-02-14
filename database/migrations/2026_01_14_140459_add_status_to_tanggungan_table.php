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
        Schema::table('tanggungan', function (Blueprint $table) {
            $table->enum('status', ['Hidup', 'Meninggal'])
                ->default('Hidup')
                ->after('hubungan');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tanggungan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
