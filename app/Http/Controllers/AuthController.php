<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,seller',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Utilisateur enregistré avec succès',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Email ou mot de passe invalide'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Connexion réussie',
            'token' => $token
        ]);
    }
}
