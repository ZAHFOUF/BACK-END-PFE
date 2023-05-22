<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livrable extends Model
{
    use HasFactory;

    public $fillable = [
        'libelle',
        'description',
        'documentPath',
        'phase_id'
    ];
}
