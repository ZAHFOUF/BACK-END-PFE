<?php

namespace App\Policies;

use App\Models\Phase;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PhasePolicy
{
     // read - edit - delete - create

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('read-phase') ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Phase $phase): bool
    {
        return $user->hasPermissionTo('read-phase') ? true : false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-phase') ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermissionTo('edit-phase') ? true : false;
    }

    /**
     * Determiner si l'utilisateur Modifier montant projet
     */

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete-phase') ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Phase $phase): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Phase $project): bool
    {
        //
    }
}
