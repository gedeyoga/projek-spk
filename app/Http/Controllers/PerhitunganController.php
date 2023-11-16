<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifRecord;
use App\Models\Kriteria;
use App\Models\KriteriaRecord;
use App\Models\PenilaianRecord;
use App\Traits\PerhitunganMoora;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    use PerhitunganMoora;

    public function index(Request $request)
    {
        $kriteria = collect();
        $alternatif = collect();
        $terbobot = collect();

        $periode = !is_null($request->get('periode')) ? date('Y-01-01' , strtotime($request->get('periode') . '-01-01')) : date('Y-01-01');
        
        if(!is_null($periode) && (strtotime($periode) < strtotime(date('Y-01-01')))) {
            $kriteria = KriteriaRecord::where('periode' , $periode)->get();
            $alternatif = AlternatifRecord::where('periode', $periode)->get();

            $terbobot = $this->pencarianNilaiRanking($alternatif , true);
        }else if((strtotime($periode) == strtotime(date('Y-01-01'))) ) {
            $kriteria = Kriteria::orderBy('id', 'asc')->get();
            $alternatif = Alternatif::all();

            $terbobot = $this->pencarianNilaiRanking($alternatif);
        }

        $can_print = $alternatif->count() > 0;
        $can_save = (strtotime($periode) == strtotime(date('Y-01-01')));

        return view('perhitungan.index' , compact([
            'kriteria' , 
            'alternatif' , 
            'terbobot',
            'can_print',
            'can_save'
        ]));
    }

    public function saveRecordPerhitungan(Request $request)
    {
        $periode = date('Y-01-01');

        AlternatifRecord::where('periode' , $periode)->delete();
        KriteriaRecord::where('periode' , $periode)->delete();

        $alternatif_data = Alternatif::all()->map(function ($item) use ($periode) {
            $item->periode = $periode;
            return $item;
        });
        $kriteria_data = Kriteria::all()->map(function ($item) use ($periode) {
            $item->periode = $periode;
            return $item;
        })->toArray();

        foreach ($kriteria_data as $kriteria) {
            KriteriaRecord::create($kriteria);
        }
        foreach ($alternatif_data as $alternatif) {
            $alternatif_record = AlternatifRecord::create($alternatif->toArray());

            foreach ($alternatif->penilaian as $penilaian) {
                $data = $penilaian->toArray();
                $data['alternatif_id'] = $alternatif_record->id;

                PenilaianRecord::create($data);
            }
        }

        return redirect()->route('perhitungan.index')->with('success', 'Berhasil menyimpan perhitungan');
    }
}
