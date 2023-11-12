<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kriterias = Kriteria::when(!is_null($request->get('search')), function ($query) use ($request) {
            return $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('type', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('kode', 'like', '%' . $request->get('search') . '%');
            });
        })
            ->when(!is_null($request->get('type')), function ($query) use ($request) {
                return $query->whereIn('type', $request->get('type'));
            })
            ->orderBy('kode', 'desc')
            ->paginate(10);

        return view('kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateKriteriaRequest $request)
    {
        $data = $request->all();

        $kriteria = Kriteria::create($data);

        return response()->json([
            'message' => 'Berhasil menambahkan data!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        return response()->json([
            'data' => $kriteria
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKriteriaRequest $request, Kriteria $kriteria)
    {
        $data = $request->all();

        $kriteria->update($data);

        return response()->json([
            'message' => 'Berhasil merubah kriteria!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return response()->json([
            'message' => 'Data dihapus!'
        ]);
    }
}
