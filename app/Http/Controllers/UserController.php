<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Liste tous les utilisateurs
    public function index() {
        $users = User::all();
        return response()->json($users);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
   // Récupérer un utilisateur par id
    public function show($id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }
        return response()->json($user);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'Utilisateur non trouvé'], 404);
    }

    // Vérifier que c'est un admin qui fait la modification
    if ($request->user()->role !== 'admin') {
        return response()->json(['error' => 'Accès refusé'], 403);
    }

    // Validation des champs modifiables
    $data = $request->validate([
        'name' => 'sometimes|string',
        'email' => 'sometimes|email|unique:users,email,' . $id,
        'password' => 'sometimes|string|min:6',
        'role' => 'sometimes|in:admin,seller',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
    ]);

    // Si le mot de passe est modifié, le hasher
    if (isset($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    }

    $user->update($data);

    return response()->json(['message' => 'Utilisateur mis à jour', 'user' => $user]);
}

    /**
     * Remove the specified resource from storage.
     */
     // Supprimer un utilisateur
    public function destroy($id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé']);
    }
}
