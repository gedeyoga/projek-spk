<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifRecord extends Model
{
    use HasFactory;

    protected $fillable = ['periode','kode', 'name'];

    protected $table = 'alternatif_records';

    public function penilaian()
    {
        return $this->hasMany(PenilaianRecord::class, 'alternatif_id');
    }

    public function ranking()
    {
        return $this->hasMany(PenilaianRecord::class, 'alternatif_id')->orderBy('kriteria_id', 'asc');
    }
}
