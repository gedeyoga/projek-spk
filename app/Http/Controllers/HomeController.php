<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        return view('dashboard.index', ['alternatifs' => Alternatif::all(), 'kriterias' => Kriteria::all(), 'rankings' =>  Ranking::with(['alternatif'])->orderBy('total_nilai', 'desc')->get()]);
    }
}
