<?php

namespace App\Http\Controllers;

use App\Models\CriticalIncident;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class CriticalIncidentController extends Controller
{
    public function index(Request $request)
    {

        $kriterias = Kriteria::with('critical_incidents')->get();


        return view('bars.critical-incident', compact('kriterias'));
    }

    public function show(CriticalIncident $critical)
    {
        return response()->json([
            'data' => $critical,
        ]);
    }

    public function update(CriticalIncident $critical , Request $request)
    {
        $critical->update($request->all());

        return response()->json([
            'message'=> 'Berhasil disimpan!'
        ]);
    }

    public function destroy(CriticalIncident $critical)
    {
        $critical->delete();

        return response()->json([
            'message'=> 'Berhasil dihapus!'
        ]);
    }

    public function store(Request $request)
    {
        $data = CriticalIncident::create($request->all());

        return response()->json([
            'message' => 'Berhasil disimpan'
        ]);
    }
}
