<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Kriteria extends Model
{
    use HasFactory , SoftDeletes , AutoNumberTrait;

    protected $table = 'kriteria';
    protected $fillable = ['kode' , 'name' , 'type', 'optimum'];

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


}
