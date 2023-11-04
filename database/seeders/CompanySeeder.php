<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => "Kid'z Cafe Sanur",
            'phone' => '080238423080',
            'address' => 'Jalan Teuku Umar',
            'logo' => url('/image/logo.jpeg'),
        ]);
    }
}
