<?php

namespace Database\Seeders;


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
        $this->call([
            UserSeeder::class,
            AlternatifSeeder::class,
            RangkingsSeeder::class,
        ]);
    }
}
