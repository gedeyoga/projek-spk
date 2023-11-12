<?php

namespace Tests\Feature;

use App\Models\Alternatif;
use App\Models\AlternatifRecord;
use App\Models\Kriteria;
use App\Models\KriteriaRecord;
use App\Models\Penilaian;
use App\Models\PenilaianRecord;
use App\Traits\PerhitunganMoora;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PerhitunganMooraTest extends TestCase
{
    use PerhitunganMoora;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNormalisasiByKriteria()
    {
        $this->seed();
        $alternatif = Alternatif::all();
        
        $penilaians = Penilaian::where('kriteria_id' , 1)->get();

        $nilai = $this->normalisasiByKriteria($penilaians->first() , $penilaians);

        $this->assertEquals(0.442, $nilai);
    }

    public function testNormalisasiMatriks()
    {
        $this->seed();
        $alternatif = Alternatif::all();
        $data = $this->normalisasiMatriks($alternatif);

        $this->assertEquals(0.442, $data->first()->penilaian->first()->matriks);
    }

    public function testMencariNilaiRanking()
    {
        $this->seed();
        $alternatif = Alternatif::all();

        $data = $this->pencarianNilaiRanking($alternatif);

        $this->assertEquals('A03' , $data->sortByDesc('total_nilai')->first()->kode);
    }

    public function testMencariNilaiRankingDariRecord()
    {
        $this->seed();

        $this->createRecord(date('Y-01-01', strtotime('-1 year')));
        $this->createRecord(date('Y-01-01', strtotime('-2 year')));

        $alternatif = AlternatifRecord::where('periode', date('Y-01-01', strtotime('-1 year')))->get();

        $data = $this->pencarianNilaiRanking($alternatif , true);

        $this->assertEquals('A03', $data->sortByDesc('total_nilai')->first()->kode);
        $this->assertCount(8, AlternatifRecord::all());
    }

    public function createRecord($periode)
    {
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
        foreach ($alternatif_data as $alternatif) {
            $alternatif_record = AlternatifRecord::create($alternatif->toArray());

            foreach ($alternatif->penilaian as $penilaian) {
                $data = $penilaian->toArray();
                $data['alternatif_id'] = $alternatif_record->id;

                PenilaianRecord::create($data);
            }
        }
    }
}
