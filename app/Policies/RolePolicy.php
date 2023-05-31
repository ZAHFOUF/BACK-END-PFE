<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;


class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user):bool
    {
        return $user->hasPermissionTo('read-role') ? true : false;
    }

    public function create(User $user):bool
    {
        return $user->hasPermissionTo('create-role') ? true : false;
    }

    public function edit(User $user):bool
    {
        return $user->hasPermissionTo('edit-role') ? true : false;
    }

    public function delete(User $user):bool
    {
        return $user->hasPermissionTo('delete-role') ? true : false;
    }


}
