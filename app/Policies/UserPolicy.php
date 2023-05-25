<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAny(User $user)
    {
        return $user->hasRole(['directeur', 'chef_projet' , 'secretaire', 'admin']) ? true : false;
    }

    public function show(User $user)
    {
        return $user->hasRole(['directeur', 'chef_projet' , 'secretaire', 'admin']) ? true : false;
    }
}
