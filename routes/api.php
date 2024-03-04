<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);





Route::middleware('auth:sanctum')->group(function () {
    Route::post('/atualizar-status', [ProdutoController::class, 'atualizarStatus']);
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

    Route::get('/produto', [ProdutoController::class, 'index']);
    Route::get('/produto/{id}', [ProdutoController::class, 'show']);
    Route::post('/produto', [ProdutoController::class, 'store']);
    Route::put('/produto/{id}', [ProdutoController::class, 'update']);
    Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);
    
    Route::get('/cliente', [ClientesController::class, 'index']);
    Route::get('/cliente/{id}', [ClientesController::class, 'show']);
    Route::post('/cliente', [ClientesController::class, 'store']);
    Route::put('/cliente/{id}', [ClientesController::class, 'update']);
    Route::delete('/cliente/{id}', [ClientesController::class, 'destroy']);

    Route::get('/venda', [VendasController::class, 'index']);
    Route::get('/venda/{id}', [VendasController::class, 'show']);
    Route::post('/venda', [VendasController::class, 'store']);
    Route::put('/venda/{id}', [VendasController::class, 'update']);
});
