<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeixesController; 

// rota teste para ver se a API está respondendo
Route::get('/', function () {
    return response()->json(['Sucesso' => true]);
});

// rotas para CRUD de Peixes
Route::get('/peixes', [PeixesController::class, 'index']);
Route::get('/peixes/{id}', [PeixesController::class, 'show']); 

Route::post('/peixes', [PeixesController::class, 'store']);

Route::put('/peixes/{id}', [PeixesController::class, 'update']);
Route::delete('/peixes/{id}', [PeixesController::class, 'destroy']);
