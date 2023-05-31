<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('read-role')) {
            $roles = Role::where('name', '!=', 'admin')->get();


        foreach ($roles as $role) {
            $role->permissions = $role->permissions()->get()->pluck("name")->unique();
        }

        return response()->json([
            'roles' => $roles
        ]);
        }


        abort(403, 'Unauthorized');


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        if ($user->hasPermissionTo('create-role')) {


            // validated request query
            $request->validate([
                'role' => 'required|max:255'
            ]);


            // ok now create role
            Role::create(['name' => $request->role , 'guard_name' => 'web']);


            // return roles
            $roles = Role::where('name', '!=', 'admin')->get();


            foreach ($roles as $role) {
                $role->permissions = $role->permissions()->get()->pluck("name")->unique();
            }


            // return a message to client
            return response()->json([
                'roles' => $roles,
            ]);


            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {






    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $role)
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('edit-role')) {
            $r = Role::findByName($role,'web');

            // checking if role exist or not
            abort_if($r ? false : true , 422 ,"there is no role with $role");

            // validted data
            $request->validate([
                'permissions' => 'array'
            ]);

            $permissions = $request->permissions;
            $r->syncPermissions($permissions);

            $roles = Role::where('name', '!=', 'admin')->get();


            foreach ($roles as $role) {
                $role->permissions = $role->permissions()->get()->pluck("name")->unique();
            }

            return response()->json([
                'roles' => $roles
            ]);
        }


        abort(403, 'Unauthorized');





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $role)
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('delete-role')) {

            $r = Role::findByName($role,'web');

            // checking if role exist or not
            abort_if($r ? false : true , 422 ,"there is no role with $role");

            $r->delete();


            $roles = Role::where('name', '!=', 'admin')->get();


            foreach ($roles as $role) {
                $role->permissions = $role->permissions()->get()->pluck("name")->unique();
            }


            return response()->json([
                'roles' => $roles
            ]);


            }
    }



}
