<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phase extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';


    protected $fillables = [
        "name" ,
        "description" ,
        "budgetPercentage" ,
        "etat_facturation" ,
        "etat_paiement" ,
        "status" ,
        "startDate" ,
        "endDate" ,
        "project" ,

    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function Livrable(): BelongsToMany
    {
        return $this->BelongsToMany(Livrable::class);
    }
}
