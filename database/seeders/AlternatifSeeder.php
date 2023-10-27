<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;


class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Alternatif::create([
            'kode' => 'a1',
            'name' => 'testing1',

        ]);

        Alternatif::create([
            'kode' => 'a2',
            'name' => 'testing2',

        ]);

        Alternatif::create([
            'kode' => 'a3',
            'name' => 'testing3',

        ]);
    }
}
