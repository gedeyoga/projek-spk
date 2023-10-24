<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory , AutoNumberTrait;

    protected $fillable = ['kode' , 'name'];

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
}
