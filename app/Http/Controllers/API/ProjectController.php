<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;




class ProjectController extends Controller
{
    public function index()
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('viewAny', Project::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        // get all projects
        $projects = Project::all('*');

    foreach ($projects as $project) {
        $organization = Organization::find($project->org);
        $user = User::find($project->chef);

        if ($organization) {
            $project->org = $organization;
            $project->chef = $user;
            $project->chef->photo = env('APP_URL').'/storage/images/'.  $project->chef->photo;

        }
    }


        return response()->json([
            'projects' => $projects
        ]);
    }


    public function filter(Request $req)
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('viewMyProject', Project::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        // get all projects
        $projects = Project::where('chef',$req->id)->get();

    foreach ($projects as $project) {
        $organization = Organization::find($project->org);
        $user = User::find($project->chef);

        if ($organization) {
            $project->org = $organization;
            $project->chef = $user;
            $project->chef->photo = env('APP_URL').'/storage/images/'.  $project->chef->photo;

        }
    }


        return response()->json([
            'projects' => $projects
        ]);
    }



    public function show(Project $id)
    {
    }

    public function store(Request $req)
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('create', Project::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }
        $project = new Project;

        $project->name = $req->name;
        $project->des =  $req->des;
        $project->budget =  $req->budget;
        $project->status =  $req->status;
        $project->progress =  $req->progress;
        $project->start_date =  $req->start_date;
        $project->end_date =  $req->end_date;
        $project->org =  $req->org;
        $project->chef =  $req->chef;

        $project->save();

        $organization = Organization::find($project->org);
        $user = User::find($project->chef);

        if ($organization) {
            $project->org = $organization;
            $project->chef = $user;
            $project->chef->photo = env('APP_URL').'/storage/images/'.  $project->chef->photo;

        }

        return response()->json([
            'project' => $project
        ]);
    }

    public function update($id,Request $req) {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('update', Project::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        $project = Project::findOrFail($id);

        $project->name = $req->name;
        $project->des =  $req->des;
        $project->budget =  $req->budget;
        $project->status =  $req->status;
        $project->progress =  $req->progress;
        $project->start_date =  $req->start_date;
        $project->end_date =  $req->end_date;
        $project->org =  $req->org;
        $project->chef =  $req->chef;

        $project->save();

        $organization = Organization::find($project->org);
        $user = User::find($project->chef);

        if ($organization) {
            $project->org = $organization;
            $project->chef = $user;
            $project->chef->photo = env('APP_URL').'/storage/images/'.  $project->chef->photo;

        }

        return response()->json([
            'project' => $project
        ]);
    }

    public function destroy($id)
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('delete', Project::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        $user =  Project::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'Project deleted',
        ]);

    }
}
