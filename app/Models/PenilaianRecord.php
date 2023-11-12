<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianRecord extends Model
{
    use HasFactory;
    
    protected $table = 'penilaian_records';

    protected $fillable = ['alternatif_id', 'kriteria_id', 'nilai'];

    public function getNilaiPangkatAttribute()
    {
        return pow($this->nilai, 2);
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaRecord::class, 'kriteria_id');
    }
}
