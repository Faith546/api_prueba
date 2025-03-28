<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//http://127.0.0.1:8000/api

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout']);
Route::post('auth/refresh', [AuthController::class, 'refresh']);
Route::post('auth/me', [AuthController::class, 'me']);

/* Route::get('/', function () {
    return response()->json([
        'message' => 'Hola desde el API de Laravel'
    ]);
});

Route::get('users/cursos', function () {
    return response()->json([
        'message' => 'Lista de cursos'
    ]);
}); */

/* Route::get('users',[UserController::class, 'index']);
Route::post('users',[UserController::class, 'store']);
Route::get('users/{id}',[UserController::class, 'show']);
Route::put('users/{id}',[UserController::class, 'update']);
Route::delete('users/{id}',[UserController::class, 'destroy']); */

Route::apiResource('users', UserController::class);
Route::apiResource('tasks', TaskController::class);

Route::get('prueba',function () { 
    return auth('api')->user(); //Retorna el usuario autenticado
});