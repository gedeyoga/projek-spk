<?php

namespace Tests\Feature;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
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
}
