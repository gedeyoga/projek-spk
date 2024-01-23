<?php

namespace Database\Seeders;

use App\Models\CriticalIncident;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class CriticalIncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriterias = Kriteria::all();

        $incidentCritials = [
            [
                'code' => 'C01',
                'datas' => [
                    'Selalu dating terlambat dan absen tanpa alasan yang jelas',
                    'Kehadiran/tingkat presensi 26% - 45%'
                ]
            ],
            [
                'code' => 'C02',
                'datas' => [
                    'Tidak mengerjakan tugas yang berikan atasan',
                    'Mengerjakan tugas yang di berikan atasan namun mengalami kendala dan tidak sesuai dengan instruksi atasan.'
                ]
            ],
            [
                'code' => 'C03',
                'datas' => [
                    'Selalu melanggar aturan-aturan dan prosedur kerja juga instruksi yang diberikan atasan',
                    'Melakukan pelanggaran atas aturan-aturan dan prosedur kerja serta instruksi dari atasan lebih dari 1 kali dalam seminggu'
                ]
            ],
            [
                'code' => 'C04',
                'datas' => [
                    'Tidak bisa sama sekali dalam berkoordinasi dan berkomunikasi dalam lingkungan kerja',
                    'Tidak menerima keputusan bersama apabila bertentangan dengan pendapatnya'
                ]
            ],
        ];


        foreach ($kriterias as $key => $kriteria) {
            
            if($incidentCritials[$key]['code'] == $kriteria->kode) {
                foreach ($incidentCritials[$key]['datas'] as $description) {
                    CriticalIncident::create([
                        'kriteria_id' => $kriteria->id,
                        'description' => $description
                    ]);
                }
            }

        }
    }
}
