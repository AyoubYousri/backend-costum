<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CostumeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Ici sont définies toutes les routes API de ton projet.
| Les routes protégées utilisent JWT via le middleware 'auth:api'.
|
*/

// ------------------------
// AUTH
// ------------------------
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// ------------------------
// ROUTES PROTÉGÉES PAR JWT
// ------------------------
Route::middleware('auth:api')->group(function () {

    // ------------------------
    // USERS (Admin seulement)
    // ------------------------
    Route::get('users', [UserController::class, 'index']);       // Liste tous les utilisateurs
    Route::get('users/{id}', [UserController::class, 'show']);   // Détails d’un utilisateur
    Route::put('users/{id}', [UserController::class, 'update']); // Modifier un utilisateur
    Route::delete('users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur

    // ------------------------
    // COSTUMES
    // ------------------------
    Route::get('costumes', [CostumeController::class, 'index']);   // Liste tous les costumes
    Route::post('costumes', [CostumeController::class, 'store']);  // Ajouter un costume
    Route::get('costumes/{id}', [CostumeController::class, 'show']); // Détails d’un costume
    Route::put('costumes/{id}', [CostumeController::class, 'update']); // Modifier un costume
    Route::delete('costumes/{id}', [CostumeController::class, 'destroy']); // Supprimer un costume

});
