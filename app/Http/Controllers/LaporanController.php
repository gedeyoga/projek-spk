<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifRecord;
use App\Models\Company;
use App\Models\Kriteria;
use App\Models\KriteriaRecord;
use App\Traits\PerhitunganMoora;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    use PerhitunganMoora;

    public function laporanRanking(Request $request)
    {
        $kriteria = collect();
        $alternatif = collect();
        $terbobot = collect();

        $periode = !is_null($request->get('periode')) ? date('Y-01-01', strtotime($request->get('periode') . '-01-01')) : date('Y-01-01');

        if (!is_null($periode) && (strtotime($periode) < strtotime(date('Y-01-01')))) {
            $kriteria = KriteriaRecord::where('periode', $periode)->orderBy('id','asc')->get();
            $alternatif = AlternatifRecord::where('periode', $periode)->get();

            $terbobot = $this->pencarianNilaiRanking($alternatif, true);
        } else {
            $kriteria = Kriteria::orderBy('id', 'asc')->get();
            $alternatif = Alternatif::all();

            $terbobot = $this->pencarianNilaiRanking($alternatif);
        }

        $company = Company::first();


        $pdf = PDF::set_option("enable_remote", true)->loadView('laporan.laporan-ranking', [
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'terbobot' => $terbobot,
            'company' => $company,
            'periode' => $periode
        ]);

        return $pdf->stream();
    }

    public function index(Request $request)
    {
        $kriteria = collect();
        $alternatif = collect();
        $terbobot = collect();

        $periode = !is_null($request->get('periode')) ? date('Y-01-01', strtotime($request->get('periode') . '-01-01')) : date('Y-01-01');

        if (!is_null($periode) && (strtotime($periode) < strtotime(date('Y-01-01')))) {
            $kriteria = KriteriaRecord::where('periode', $periode)->orderBy('id', 'asc')->get();
            $alternatif = AlternatifRecord::where('periode', $periode)->get();

            $terbobot = $this->pencarianNilaiRanking($alternatif, true);
        } else {
            $kriteria = Kriteria::orderBy('id', 'asc')->get();
            $alternatif = Alternatif::all();

            $terbobot = $this->pencarianNilaiRanking($alternatif);
        }

        $company = Company::first();

        return view('laporan.index', compact(['kriteria', 'alternatif', 'terbobot', 'company']));
    }
}
