<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Performance;
use Illuminate\Database\Seeder;

class PerformanceSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriterias = Kriteria::all();

        $performances = [
            [
                'code' => 'C01',
                'datas' => [
                    'Secara konsisten, selalu hadir tetpat waktu, dengan tingkat absensi 0%',
                    'Kehadiran/tingkat presensi 76% - 99%',
                    'Kehadiran/tingkat presensi 50% - 75%',
                ]
            ],
            [
                'code' => 'C02',
                'datas' => [
                    'Mengerjakan tugas yang di berikan sesuai dengan instruksi yang diberikan',
                    'Mengerjakan tugas yang diberikan atasan namun masih mengalami kendala dalam pelaksanaanya',
                    'Mengerjakan tugas yang diberikan meskipun tidak sesuai dengan instruksi yang diberikan atasan',
                ]
            ],
            [
                'code' => 'C03',
                'datas' => [
                    'Selalu mentaati aturan-aturan dan prosedur kerja serta menepati instruksi yang diberikan atasan',
                    'Sekali tidak menaati aturan-aturan dan prosedur kerja serta menepati instruksi yang dibeerikan atasan',
                    'Tidak melakukan dan mentaati perintah atasan lebih dari 3 kali dalam sebulan'
                ]
            ],
            [
                'code' => 'C04',
                'datas' => [
                    'Mampu berkoordinasi dan berkomunikasi dengan berbagai pihak, dan menghargai pendapat orang lain, serta mampu menyelesaikan masalah kerja tim',
                    'Mampu berkoordinasi dan berkomunikasi dengan baik tetapi kurang mampu dalam menyelesaikan masalah kerja tim',
                    'Kurang mampu berkoordinasi,dan  berkomunikasi serta kurang mampu menyelesaikan masalah kerja tim'
                ]
            ],
        ];


        foreach ($kriterias as $key => $kriteria) {

            if ($performances[$key]['code'] == $kriteria->kode) {
                foreach ($performances[$key]['datas'] as $description) {
                    Performance::create([
                        'kriteria_id' => $kriteria->id,
                        'description' => $description
                    ]);
                }
            }
        }
    }
}
