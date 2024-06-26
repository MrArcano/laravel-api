<?php

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Get All projects
Route::get('/projects-api',[ProjectController::class , 'index']);

// Get All project by Type

// Get All project by Tecnology

// Get Detail project by slug
Route::get('/get-project/{slug}',[ProjectController::class , 'getProject']);

// Send email
Route::post('/send-email',[LeadController::class, 'store']);
