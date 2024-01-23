<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index(Request $request)
    {

        $kriterias = Kriteria::with('performances')->get();


        return view('bars.performance', compact('kriterias'));
    }

    public function show(Performance $performance)
    {
        return response()->json([
            'data' => $performance,
        ]);
    }

    public function update(Performance $performance, Request $request)
    {
        $performance->update($request->all());

        return response()->json([
            'message' => 'Berhasil disimpan!'
        ]);
    }

    public function destroy(Performance $performance)
    {
        $performance->delete();

        return response()->json([
            'message' => 'Berhasil dihapus!'
        ]);
    }

    public function store(Request $request)
    {
        $data = Performance::create($request->all());

        return response()->json([
            'message' => 'Berhasil disimpan'
        ]);
    }
}
