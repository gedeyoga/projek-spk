<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Traits\PerhitunganMoora;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    use PerhitunganMoora;

    public function index(Request $request)
    {
        $kriteria = Kriteria::orderBy('id' , 'asc')->get();
        $alternatif = Alternatif::all();

        $terbobot = $this->pencarianNilaiRanking($alternatif);

        return view('perhitungan.index' , compact(['kriteria' , 'alternatif' , 'terbobot']));
    }
}
