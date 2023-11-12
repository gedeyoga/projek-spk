<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\AlternatifRecord;
use App\Models\Kriteria;
use App\Models\KriteriaRecord;
use App\Models\PenilaianRecord;
use Illuminate\Database\Seeder;

class AlternatifRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periode = date('Y-01-01' , strtotime('-1 year'));

        $alternatif_data = Alternatif::all()->map(function ($item) use ($periode) {
            $item->periode = $periode;
            return $item;
        });
        $kriteria_data = Kriteria::all()->map(function ($item) use ($periode) {
            $item->periode = $periode;
            return $item;
        })->toArray();

        foreach ($kriteria_data as $kriteria) {
            KriteriaRecord::create($kriteria);
        }
        foreach ($alternatif_data->take(3) as $alternatif) {
            $alternatif_record = AlternatifRecord::create($alternatif->toArray());

            foreach ($alternatif->penilaian as $penilaian) {
                $data = $penilaian->toArray();
                $data['alternatif_id'] = $alternatif_record->id;

                PenilaianRecord::create($data);
            }
        }
    }
}
