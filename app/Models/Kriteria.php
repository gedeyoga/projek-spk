<?php

namespace App\Models;

use App\Models\KriteriaNilai;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory, SoftDeletes, AutoNumberTrait;

    protected $table = 'kriteria';
    protected $fillable = ['kode', 'name', 'type', 'optimum'];

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
                    return 'C?';
                },
                'length' => 2
            ]
        ];
    }

    public function kriteria_nilai()
    {
        return  $this->hasMany(KriteriaNilai::class, 'kriteria_id');
    }
}
