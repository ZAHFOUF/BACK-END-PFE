<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class UserSelfController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $user = new UserResource($user);
        $roles = $user->roles; // Get the user's roles

        $permissions = $roles->flatMap(function (Role $role) {
            return $role->permissions;
        })->pluck('name')->unique(); // Get the permissions associated with the roles

        return response()->json([
            'user' => $user,
            'permissions' => $permissions
        ]);


    }

    public function show($id)
    {


    }

    public function store(Request $request)
    {

    }

    public function update($id,Request $request)
    {

    }

    public function destroy(User $user)
    {

    }
}
