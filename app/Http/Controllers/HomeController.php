<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\AlternatifRecord;
use App\Models\KriteriaRecord;
use App\Traits\PerhitunganMoora;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use PerhitunganMoora;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

        return view('dashboard.index', [
            'alternatifs' => $alternatif, 
            'kriterias' => $kriteria, 
            'rankings' =>  $terbobot->sortByDesc('total_nilai')
        ]);
    }
}
