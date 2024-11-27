<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // Récupérer tous les clients
        return response()->json(Client::all());
    }

    public function store(Request $request)
    {
        // Valider et créer un client
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'numero_cnib' => 'required|string|unique:clients',
            'date_delivrance' => 'required|date',
            'date_expiration' => 'required|date',
            'telephone_secondaire' => 'nullable|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'lieu_delivrance' => 'required|string|max:255',
        ]);

        $client = Client::create($validated);

        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        // Récupérer un client spécifique
        return response()->json($client);
    }

    public function update(Request $request, Client $client)
    {
        // Mettre à jour un client
        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prenoms' => 'sometimes|string|max:255',
            'numero_cnib' => 'sometimes|string|unique:clients,numero_cnib,' . $client->id,
            'date_delivrance' => 'sometimes|date',
            'date_expiration' => 'sometimes|date',
            'telephone_secondaire' => 'nullable|string',
            'date_naissance' => 'sometimes|date',
            'lieu_naissance' => 'sometimes|string|max:255',
            'lieu_delivrance' => 'sometimes|string|max:255',
        ]);

        $client->update($validated);

        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        // Supprimer un client
        $client->delete();

        return response()->json(['message' => 'Client supprimé avec succès']);
    }
}
