<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $table = 'rankings';

    protected $fillable = ['alternatif_id', 'total_nilai'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}
