<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ranking;

class RangkingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ranking::create([
            'alternatif_id' => '1',
            'total_nilai' => '1000',
        ]);

        Ranking::create([
            'alternatif_id' => '2',
            'total_nilai' => '2000',
        ]);

        Ranking::create([
            'alternatif_id' => '3',
            'total_nilai' => '3000',
        ]);
    }
}
