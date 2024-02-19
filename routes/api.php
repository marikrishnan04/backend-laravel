<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Define routes for LoginController
Route::get('login', [LoginController::class, 'index']); // GET request
Route::post('login', [LoginController::class, 'store']); // POST request
Route::put('login/{id}', [LoginController::class, 'update']); // PUT request
Route::delete('login/{id}', [LoginController::class, 'destroy']); // DELETE request

