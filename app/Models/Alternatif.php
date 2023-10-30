<?php

namespace App\Models;

use App\Models\Ranking;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
    use HasFactory, AutoNumberTrait;

    protected $fillable = ['kode', 'name'];

    protected $table = 'alternatif';

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'kode' => [
                'format' => function () {
                    return 'A?';
                },
                'length' => 2
            ]
        ];
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id');
    }

    public function ranking()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id')->orderBy('kriteria_id', 'asc');
    }
}
