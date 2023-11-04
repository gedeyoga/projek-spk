<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Database\Seeders\RangkingsSeeder;
use Database\Seeders\AlternatifSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KriteriaSeeder::class);
        $this->call(AlternatifSeeder::class);
    }
}
