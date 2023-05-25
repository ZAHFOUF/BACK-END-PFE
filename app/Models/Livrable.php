<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Livrable extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'filePath',
        'phase',
        'External'
    ];

    public function phase(): HasOne
    {
        return $this->hasOne(Phase::class);
    }
}
