<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LivrableController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\API\OrganismeController;
use App\Http\Controllers\API\PhasesController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\API\UserSelfController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Contracts\Role;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Users End points
Route::prefix('/users')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
        // Create a user
        Route::post('/', [UserController::class, 'store']);
        // Update a user
        Route::put('/{user}', [UserController::class, 'update']);
        // Delete a user
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

// User End points
Route::prefix('/user')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [UserSelfController::class, 'index']);
        Route::get('/{user}', [UserSelfController::class, 'show']);
        // Create a user
        Route::post('/', [UserSelfController::class, 'store']);
        // Update a user
        Route::put('/{user}', [UserSelfController::class, 'update']);
        // Delete a user
        Route::delete('/{user}', [UserSelfController::class, 'destroy']);
    });

// Organisations Endpoint
Route::prefix('/organisations')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [OrganismeController::class, 'index']);
        Route::get('/{organisation}', [OrganismeController::class, 'show']);
        Route::post('/', [OrganismeController::class, 'store']);
        Route::put('/{organisation}', [OrganismeController::class, 'update']);
        Route::delete('/{organisation}', [OrganismeController::class, 'destroy']);
    });

// Projects End points
Route::prefix('projects')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/filter', [ProjectController::class, 'filter']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::put('/{id}', [ProjectController::class, 'update']);
        Route::delete('/{id}', [ProjectController::class, 'destroy']);
    });

// Phases End points
Route::prefix('phases')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [PhasesController::class, 'index']);
        Route::get('/{id}', [PhasesController::class, 'show']);
        Route::post('/', [PhasesController::class, 'store']);
        Route::put('/{id}', [PhasesController::class, 'update']);
        Route::delete('/{id}', [PhasesController::class, 'destroy']);
    });



 // Livrables End points
Route::prefix('livrables')
->middleware(['auth:sanctum'])
->group(function () {
Route::get('/', [LivrableController::class, 'index']);
Route::get('/{id}', [LivrableController::class, 'show']);
Route::post('/', [LivrableController::class, 'store']);
Route::put('/{id}', [LivrableController::class, 'update']);
Route::delete('/{id}', [LivrableController::class, 'destroy']);
    });

 // Roles End points
 Route::prefix('roles')
 ->middleware(['auth:sanctum'])
 ->group(function () {
 Route::get('/', [RolesController::class, 'index']);
 Route::get('/{role}', [RolesController::class, 'show']);
 Route::post('/', [RolesController::class, 'store']);
 Route::put('/{role}', [RolesController::class, 'update']);
 Route::delete('/{role}', [RolesController::class, 'destroy']);
     });


Route::get('/refresh-database', function () {
    Artisan::call('migrate:fresh --seed');
    return response('Database refreshed and seeded successfully');
});



Route::get("/send",[ProjectController::class,'send']);
