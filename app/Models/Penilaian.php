<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['alternatif_id' , 'kriteria_id' , 'nilai'];
    protected $table = 'penilaian';

    public function getNilaiPangkatAttribute()
    {
        return pow($this->nilai, 2);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
