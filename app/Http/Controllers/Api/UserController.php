<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Lista de usuarios'
        ]);
    }

    public function store()
    {
        return response()->json([
            'message' => 'Usuario creado'
        ]);
    }

    public function show($user)
    {
        return response()->json([
            'message' => 'Usuario recuperado: ' . $user
        ]);
    }

    public function update($user)
    {
        return response()->json([
            'message' => 'Usuario actualizado: ' . $user
        ]);
    }

    public function destroy($user)
    {
        return response()->json([
            'message' => 'Usuario eliminado: ' . $user
        ]);
    }
}
