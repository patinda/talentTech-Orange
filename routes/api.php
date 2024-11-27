<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeTransactionController;
use Illuminate\Support\Facades\Route;

Route::apiResource('clients', ClientController::class);
Route::apiResource('transactions', TransactionController::class);
Route::apiResource('type-transactions', TypeTransactionController::class);
