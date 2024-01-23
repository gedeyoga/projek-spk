<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class BarsController extends Controller
{
    public function index(Request $request)
    {

        $kriterias = Kriteria::with('kriteria_nilai')->get();


        return view('bars.final-instrument', compact('kriterias'));
    }

    public function incident(Request $request)
    {
        return view('bars.critical-incident');
    }
}
