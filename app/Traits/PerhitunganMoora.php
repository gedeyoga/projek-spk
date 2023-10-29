<?php 

namespace App\Traits;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Collection;

trait PerhitunganMoora
{

    public function normalisasiByKriteria(Penilaian $penilaian, Collection $penilaianByKriteria)
    {
        $hitung = $penilaian->nilai / sqrt($penilaianByKriteria->sum('nilai_pangkat'));
        return number_format($hitung, 3);
    }

    public function normalisasiMatriks(Collection $alternatifs)
    {
        $penilaian_all = Penilaian::all();

        foreach ($alternatifs as $alternatif) {
            foreach ($alternatif->penilaian as $data_nilai) {
                $data_nilai->matriks = $this->normalisasiByKriteria($data_nilai, $penilaian_all->where('kriteria_id' , $data_nilai->kriteria_id));
            }
        }

        return $alternatifs;
    }

    public function pencarianNilaiRanking(Collection $alternatifs)
    {
        $alternatif_ternormalisasi = $this->normalisasiMatriks($alternatifs);

        foreach ($alternatif_ternormalisasi as $alternatif) {
            $max = collect();
            $min = collect();

            foreach ($alternatif->penilaian as $data_nilai) {
                if($data_nilai->kriteria->type == 'benefit') {
                    $max->push($data_nilai);
                }else {
                    $min->push($data_nilai);
                }
            }

            $alternatif->total_nilai = $max->sum('matriks') - $min->sum('matriks');
        }

        return $alternatif_ternormalisasi;
    }

}
