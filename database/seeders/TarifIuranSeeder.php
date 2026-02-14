<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TarifIuran;

class TarifIuranSeeder extends Seeder
{
    public function run(): void
    {
        TarifIuran::updateOrCreate(
            ['tahun_mulai' => 2020],
            ['nominal' => 10000]
        );

        TarifIuran::updateOrCreate(
            ['tahun_mulai' => 2026],
            ['nominal' => 20000]
        );
    }
}
