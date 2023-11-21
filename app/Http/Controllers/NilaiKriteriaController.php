<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKriteriaNilaiRequest;
use App\Models\Kriteria;
use App\Models\KriteriaNilai;
use Illuminate\Http\Request;

class NilaiKriteriaController extends Controller
{
    public function index(Request $request)
    {

        $nilaiKriterias = KriteriaNilai::when(!is_null($request->get('search')), function ($query) use ($request) {
            return $query->whereHas('kriteria', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->get('search') . '%');
            });
        })->paginate(10);


        $kriterias = Kriteria::all();


        return view('nilai-kriteria.index', compact('nilaiKriterias', 'kriterias'));
    }

    public function store(CreateKriteriaNilaiRequest $request)
    {

        $kriteriaId = $request->kriteria;
        $ket = [$request->nilai1, $request->nilai2, $request->nilai3, $request->nilai4, $request->nilai5];
        KriteriaNilai::create([
            'kriteria_id' => $kriteriaId,
            'ket1' => $ket[0],
            'ket2' =>  $ket[1],
            'ket3' =>  $ket[2],
            'ket4' =>  $ket[3],
            'ket5' =>  $ket[4],
        ]);


        return response()->json([
            'message' => 'Berhasil menambahkan data!'
        ]);
    }

    public function edit(KriteriaNilai $kriteria)
    {
        return response()->json([
            'data' => $kriteria,
            'kriteria' => $kriteria->kriteria->name
        ]);
    }

    public function update(KriteriaNilai $kriteria, Request $request)
    {

        $data = $request->all();


        $kriteria->update($data);


        return response()->json([
            'message' => 'Berhasil merubah kriteria!',
        ]);
    }

    public function destroy(KriteriaNilai $kriteria)
    {
        $kriteria->delete();
        return response()->json([
            'message' => 'Data dihapus!'
        ]);
    }
}
