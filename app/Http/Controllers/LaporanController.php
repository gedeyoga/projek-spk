<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Company;
use App\Models\Kriteria;
use App\Traits\PerhitunganMoora;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    use PerhitunganMoora;

    public function laporanRanking(Request $request)
    {
        $kriteria = Kriteria::orderBy('id', 'asc')->get();
        $alternatif = Alternatif::all();

        $company = Company::first();

        $terbobot = $this->pencarianNilaiRanking($alternatif);

        $pdf = PDF::set_option("enable_remote", true)->loadView('laporan.laporan-ranking', [
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'terbobot' => $terbobot,
            'company' => $company,
        ]);

        return $pdf->stream();
    }

    public function index(Request $request)
    {
        $kriteria = Kriteria::orderBy('id', 'asc')->get();
        $alternatif = Alternatif::all();

        $terbobot = $this->pencarianNilaiRanking($alternatif);

        $company = Company::first();

        return view('laporan.index', compact(['kriteria', 'alternatif', 'terbobot', 'company']));
    }
}
