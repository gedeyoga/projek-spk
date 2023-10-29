<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kriteria::truncate();
        
        $data = [
            [
                'kode' => 'C01',
                'name' => 'Disiplin', 
                'type' => 'benefit', 
                'optimum' => 'max',
            ],
            [
                'kode' => 'C02',
                'name' => 'Hasil Kerja', 
                'type' => 'benefit', 
                'optimum' => 'max',
            ],
            [
                'kode' => 'C03',
                'name' => 'Tanggung Jawab', 
                'type' => 'benefit', 
                'optimum' => 'max',
            ],
            [
                'kode' => 'C04',
                'name' => 'Kerja Sama Tim', 
                'type' => 'benefit', 
                'optimum' => 'max',
            ],
        ];

        foreach ($data as $item) {
            Kriteria::create($item);
        }
    }
}
