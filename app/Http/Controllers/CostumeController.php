<?php

namespace App\Http\Controllers;

use App\Models\Costume;
use Illuminate\Http\Request;

class CostumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Costume::with('seller')->get());

    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request) {
        $data = $request->validate([
            'seller_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'required|string'
        ]);

        $costume = Costume::create($data);
        return response()->json($costume);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $costume = Costume::findOrFail($id); // Cherche le costume ou renvoie 404

    $data = $request->validate([
        'seller_id' => 'sometimes|exists:users,id',
        'name' => 'sometimes|string',
        'description' => 'sometimes|string',
        'price' => 'sometimes|numeric',
        'image_url' => 'sometimes|string'
    ]);

    $costume->update($data); // Met à jour les champs fournis

    return response()->json([
        'message' => 'Costume mis à jour avec succès',
        'costume' => $costume
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $costume = Costume::findOrFail($id); // Cherche le costume ou renvoie 404
    $costume->delete(); // Supprime le costume

    return response()->json([
        'message' => 'Costume supprimé avec succès'
    ]);
}

}
