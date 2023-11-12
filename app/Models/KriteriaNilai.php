<?php

namespace App\Models;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KriteriaNilai extends Model
{
    use HasFactory;

    protected $fillable = ['kriteria_id', 'ket1', 'ket2', 'ket3', 'ket4', 'ket5'];

    public function kriteria()
    {
        return  $this->belongsTo(Kriteria::class);
    }
}
