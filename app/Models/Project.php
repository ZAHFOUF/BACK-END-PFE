<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'des',
        'budget',
        'status' ,
        'progress' ,
        'org',
        'start_date',
        'end_date' ,
    ];

    public $timestamps = false;

    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class);
    }

    public function organizations(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
