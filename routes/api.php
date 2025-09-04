<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// rotas para visualizar os registros
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/peixes',[PeixesController::class, 'index']);
Route::get('/peixes/{codigo}' ,[PeixesController::class,'show']);

Route::post('/peixes' ,[PeixesController::class, 'store']);

Route::put('/peixes/{codigo}' ,[PeixesController::class, 'update']);

Route::delete('/peixes/{id}' ,[PeixesController::class, 'destroy']);
