<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\Penilaian;
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
        $res = Alternatif::all();

        foreach ($res as $item) {
            $item->delete();
        }

        $datas = [
            [
                'name' => 'Luh Putu Manik Yuningsih',
                'penilaian' => [
                    [
                        'kriteria_id' => 1,
                        'nilai' => 4,
                    ],
                    [
                        'kriteria_id' => 2,
                        'nilai' => 5,
                    ],
                    [
                        'kriteria_id' => 3,
                        'nilai' => 4,
                    ],
                    [
                        'kriteria_id' => 4,
                        'nilai' => 4,
                    ],
                ]
            ],
            [
                'name' => 'Ni Wayan Yunik Wilandari',
                'penilaian' => [
                    [
                        'kriteria_id' => 1,
                        'nilai' => 5,
                    ],
                    [
                        'kriteria_id' => 2,
                        'nilai' => 3,
                    ],
                    [
                        'kriteria_id' => 3,
                        'nilai' => 5,
                    ],
                    [
                        'kriteria_id' => 4,
                        'nilai' => 4,
                    ],
                ]
            ],
            [
                'name' => 'Ni Wayan Sariani',
                'penilaian' => [
                    [
                        'kriteria_id' => 1,
                        'nilai' => 4,
                    ],
                    [
                        'kriteria_id' => 2,
                        'nilai' => 5,
                    ],
                    [
                        'kriteria_id' => 3,
                        'nilai' => 4,
                    ],
                    [
                        'kriteria_id' => 4,
                        'nilai' => 5,
                    ],
                ]
            ],
            [
                'name' => 'I Made Raihan',
                'penilaian' => [
                    [
                        'kriteria_id' => 1,
                        'nilai' => 5,
                    ],
                    [
                        'kriteria_id' => 2,
                        'nilai' => 4,
                    ],
                    [
                        'kriteria_id' => 3,
                        'nilai' => 3,
                    ],
                    [
                        'kriteria_id' => 4,
                        'nilai' => 3,
                    ],
                ]
            ],
        ];

        foreach ($datas as $data) {
            $alternatif = Alternatif::create([
                'name' => $data['name'],
            ]);
            foreach ($data['penilaian'] as $data_nilai) {
                $data_nilai['alternatif_id'] = $alternatif->id;

                $penilaian= Penilaian::create($data_nilai);
            }

        }
    }
}
