<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\Kriteria;
use App\Models\Alternatif;
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
    public function index()
    {
        $alternatifs = Alternatif::all();
        $rankings = $this->pencarianNilaiRanking($alternatifs);

        return view('dashboard.index', [
            'alternatifs' => $alternatifs, 
            'kriterias' => Kriteria::all(), 
            'rankings' =>  $rankings->sortByDesc('total_nilai')
        ]);
    }
}
