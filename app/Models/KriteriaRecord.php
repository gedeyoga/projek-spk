<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KriteriaRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kriteria_records';
    protected $fillable = [ 'periode','kode', 'name', 'type', 'optimum'];
}
