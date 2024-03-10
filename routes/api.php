<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ParcelasController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\UserController;

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/cliente', [ClientesController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);
    
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);
    
    Route::post('/produto', [ProdutoController::class, 'store']);
    Route::get('/produto', [ProdutoController::class, 'index']);
    Route::get('/produto/{id}', [ProdutoController::class, 'show']);
    Route::put('/produto/{id}', [ProdutoController::class, 'update']);
    Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);
    
    Route::post('/cliente', [ClientesController::class, 'store']);
    Route::get('/cliente/{id}', [ClientesController::class, 'show']);
    Route::put('/cliente/{id}', [ClientesController::class, 'update']);
    Route::delete('/cliente/{id}', [ClientesController::class, 'destroy']);
    
    Route::post('/venda', [VendasController::class, 'store']);
    Route::get('/venda', [VendasController::class, 'index']);
    Route::get('/venda/{id}', [VendasController::class, 'show']);
    Route::put('/venda/{id}', [VendasController::class, 'update']);
});
