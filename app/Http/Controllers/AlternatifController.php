<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {

        $alternatifs = Alternatif::when(!is_null($request->get('search')), function ($query) use ($request) {
            return $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->get('search') . '%');
            });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.create', ['kriterias' => Kriteria::all()]);
    }

    public function store(Request $request)
    {

        $alternatif = new Alternatif;
        $alternatif->name = $request->name;
        $alternatif->save();


        $kriterias = Kriteria::all();
        $datas = $request->all();
        $propertyNames = array_keys($datas);

        $propertyNames = array_map(function ($item) {
            return str_replace('_', ' ', $item);
        }, $propertyNames);



        $data = [];

        foreach ($kriterias as $kriteria) {
            foreach ($propertyNames as $data) {
                if ($data === $kriteria->name) {
                    $convertDataStrToUnderScore = str_replace(' ', '_', $data);
                    Penilaian::create([
                        'alternatif_id' => $alternatif->id,
                        'kriteria_id' => $kriteria->id,
                        'nilai' => $datas[$convertDataStrToUnderScore]
                    ]);
                }
            }
        }


        return redirect('/alternatif')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Alternatif $alternatif)
    {



        return view('alternatif.edit', ['alternatif' => $alternatif, 'kriterias' => Kriteria::all()]);
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $alternatif->update([
            'name' => $request->name
        ]);

        $kriterias = Kriteria::all();
        $datas = $request->all();
        $propertyNames = array_keys($datas);

        $propertyNames = array_map(function ($item) {
            return str_replace('_', ' ', $item);
        }, $propertyNames);

        $data = [];

        foreach ($kriterias as $kriteria) {
            foreach ($propertyNames as $data) {
                if ($data === $kriteria->name) {
                    $convertDataStrToUnderScore = str_replace(' ', '_', $data);
                    Penilaian::where('alternatif_id', $alternatif->id)
                        ->where('kriteria_id', $kriteria->id)
                        ->update(['nilai' => $datas[$convertDataStrToUnderScore]]);
                }
            }
        }

        return redirect('/alternatif')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        Penilaian::where('alternatif_id', $alternatif->id)->delete();


        return response()->json([
            'message' => 'Data dihapus!'
        ]);
    }
}
