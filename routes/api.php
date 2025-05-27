<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupsUserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-user', [UserController::class, 'store']);
Route::get('/get-users', [UserController::class, 'index']);

Route::get('/get-groups', [GroupsUserController::class, 'index']);
Route::post('/create-group', [GroupsUserController::class, 'store']);
Route::post('/assign-group-to-user', [GroupsUserController::class, 'assignToWp']);
Route::put('/wp/{id}', [UserController::class, 'update']);
Route::delete('/wp/{id}', [UserController::class, 'destroy']);
Route::put('/groups-user/{id}', [GroupsUserController::class, 'update']);
Route::delete('/grou    ps-user/{id}', [GroupsUserController::class, 'destroy']);
Route::delete('/groups-user/unassign', [GroupsUserController::class, 'unassignFromWp']);
