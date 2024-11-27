<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
{
    // Récupérer toutes les transactions avec leurs relations
    $transactions = Transaction::with(['client', 'typeTransaction'])->get();

    return response()->json($transactions);
}


public function store(Request $request)
{
    // Valider la transaction
    $validated = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'date' => 'required|date',
        'type_transaction_id' => 'required|exists:type_transactions,id',
    ]);

    // Créer la transaction
    $transaction = Transaction::create($validated);

    // Retourner la transaction avec ses relations
    return response()->json($transaction->load(['client', 'typeTransaction']), 201);
}

public function show(Transaction $transaction)
{
    // Charger les relations
    $transaction->load(['client', 'typeTransaction']);

    return response()->json($transaction);
}


    public function update(Request $request, Transaction $transaction)
    {
        // Mettre à jour une transaction
        $validated = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'date' => 'sometimes|date',
            'type_transaction_id' => 'sometimes|exists:type_transactions,id',
        ]);

        $transaction->update($validated);

        return response()->json($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        // Supprimer une transaction
        $transaction->delete();

        return response()->json(['message' => 'Transaction supprimée avec succès']);
    }
}
