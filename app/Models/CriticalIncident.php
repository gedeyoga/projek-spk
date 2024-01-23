<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriticalIncident extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'description',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class , 'kriteria_id');
    }
}
