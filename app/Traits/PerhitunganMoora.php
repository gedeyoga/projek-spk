<?php 

namespace App\Traits;

use App\Models\Penilaian;
use App\Models\PenilaianRecord;
use Illuminate\Database\Eloquent\Collection;

trait PerhitunganMoora
{

    public $penilaian_model = Penilaian::class;

    public function normalisasiByKriteria($penilaian, Collection $penilaianByKriteria)
    {
        $hitung = $penilaian->nilai / sqrt($penilaianByKriteria->sum('nilai_pangkat'));
        return number_format($hitung, 3);
    }

    public function normalisasiMatriks(Collection $alternatifs)
    {
        $penilaian_all = $this->penilaian_model::whereIn('alternatif_id', $alternatifs->map(fn ($item) => $item->id)->toArray())->get();

        foreach ($alternatifs as $alternatif) {
            foreach ($alternatif->penilaian as $data_nilai) {
                $data_nilai->matriks = $this->normalisasiByKriteria($data_nilai, $penilaian_all->where('kriteria_id' , $data_nilai->kriteria_id));
            }
        }

        return $alternatifs;
    }

    public function pencarianNilaiRanking(Collection $alternatifs , $from_record = false)
    {

        if($from_record) {
            $this->penilaian_model = PenilaianRecord::class;
        }

        $alternatif_ternormalisasi = $this->normalisasiMatriks($alternatifs);

        foreach ($alternatif_ternormalisasi as $alternatif) {
            $max = collect();
            $min = collect();

            foreach ($alternatif->penilaian as $data_nilai) {
                if(!is_null($data_nilai)) {
                    if ($data_nilai->kriteria->type == 'benefit') {
                        $max->push($data_nilai);
                    } else {
                        $min->push($data_nilai);
                    }
                }
            }

            $alternatif->total_nilai = $max->sum('matriks') - $min->sum('matriks');
        }

        return $alternatif_ternormalisasi;
    }

}
