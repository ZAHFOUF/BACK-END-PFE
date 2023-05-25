<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Livrable;
use App\Models\Phase;
use App\Models\PhaseUser;
use App\Models\Project;
use App\Models\User;
use Brick\Math\BigInteger;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;



use Illuminate\Http\Request;

class PhasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)  {
        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('viewAny', Phase::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        $phases = Phase::where("project",$req->id)->get();

        if ($phases) {




            foreach ($phases as $phase) {
                $assignedFinal = [];
                $livrebles = Livrable::where('phase',$phase->code)->get();
                $assignedEmployees = PhaseUser::where('phase',$phase->code)->get();
                foreach ($assignedEmployees as $assignedEmployee) {
                    $user = User::where('id',$assignedEmployee->user)->get();
                    array_push($assignedFinal,UserResource::collection($user));

                }



                if ($livrebles) {
                    $phase->deliverables = $livrebles;
                    $phase->assignedEmployees = $assignedFinal;

                }
            }
        }

        return response()->json([
            'phases' => $phases
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('create', Phase::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }


        $phase = new Phase;

        $phase->project = $req->project ;

        $phase->name = $req->name ;
        $phase->description = $req->description ;
        $phase->budgetPercentage = $req->budgetPercentage ;
        $phase->status = $req->status ;
        $phase->startDate = $req->startDate;
        $phase->endDate = $req->endDate ;

       $phase->save();

       $phase->refresh();

       $assignedEmployees = $req->assignedEmployees ;
       foreach ($assignedEmployees as $user ) {

        $id = $user['id'];



        PhaseUser::create(['phase' => $phase->code , 'user' => $id ]);

       }







       return response()->json([
        'id' => $phase->code
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('update', Phase::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }


        $phase = Phase::findOrFail($id);

        if ($request->edit) {
            $filed = $request->edit ;
            $phase->$filed = $request->value ;
            $phase->save();
            return response()->json(['message' => $phase]);
        }

        return 0;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('update', Phase::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        $phase = Phase::findOrFail($id);

        $phase->delete();

        return response()->json([
            'message' => 'Project deleted',
        ]);




    }
}



