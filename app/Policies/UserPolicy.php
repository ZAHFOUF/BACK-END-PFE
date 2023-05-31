<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAny(User $user)
    {
        return $user->hasPermissionTo('read-user') ? true : false;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create-user') ? true : false;
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo('edit-user') ? true : false;
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('delete-user') ? true : false;
    }

    public function refrechDb(User $user)
    {
        return $user->hasPermissionTo('refrech-db') ? true : false;
    }


}
