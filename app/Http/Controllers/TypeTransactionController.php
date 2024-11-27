<?php

namespace App\Http\Controllers;

use App\Models\TypeTransaction;
use Illuminate\Http\Request;

class TypeTransactionController extends Controller
{
    public function index()
    {
        // Récupérer tous les types de transaction
        return response()->json(TypeTransaction::all());
    }

    public function store(Request $request)
    {
        // Valider et créer un type de transaction
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_transactions',
        ]);

        $typeTransaction = TypeTransaction::create($validated);

        return response()->json($typeTransaction, 201);
    }

    public function show(TypeTransaction $typeTransaction)
    {
        // Récupérer un type de transaction spécifique
        return response()->json($typeTransaction);
    }

    public function update(Request $request, TypeTransaction $typeTransaction)
    {
        // Mettre à jour un type de transaction
        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255|unique:type_transactions,nom,' . $typeTransaction->id,
        ]);

        $typeTransaction->update($validated);

        return response()->json($typeTransaction);
    }

    public function destroy(TypeTransaction $typeTransaction)
    {
        // Supprimer un type de transaction
        $typeTransaction->delete();

        return response()->json(['message' => 'Type de transaction supprimé avec succès']);
    }
}
