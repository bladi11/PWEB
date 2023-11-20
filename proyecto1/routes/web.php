<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController; //tarea
use App\Http\Controllers\InscripcionController; // Parcial 2
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\MotoController; //Practica Parcial 3
use App\Http\Controllers\TareaController; //Examen Final

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('inscripcion1')->group(function(){
    //Parcial 2
    Route::get('/getAll', [InscripcionController::class, 'showAll']);
    Route::get('/getById/{id}', [InscripcionController::class, 'showById']);
    Route::post('/create', [InscripcionController::class, 'store']);
    Route::put('/update/{id}', [InscripcionController::class, 'update']);
    Route::delete('/delete/{id}', [InscripcionController::class, 'destroy']);
    Route::put('/desactivar/{id}',[ InscripcionController::class, 'deactivate']);
    Route::put('/activar/{id}',[ InscripcionController::class, 'activate']);
});

Route::prefix('vehiculo')->group(function(){
    //Tarea grupo
    Route::get('/getAll', [VehiculoController::class, 'showAll']);
    Route::get('/getById/{id}', [VehiculoController::class, 'showById']);
    Route::post('/create', [VehiculoController::class, 'store']);
    Route::put('/update/{id}', [VehiculoController::class, 'update']);
    Route::delete('/delete/{id}', [VehiculoController::class, 'destroy']);
    Route::put('/desactivar/{id}',[ VehiculoController::class, 'deactivate']);
    Route::put('/activar/{id}',[ VehiculoController::class, 'activate']);
});
Route::prefix('motos')->group(function(){
    //practica parcial 3
    Route::get('/getAll', [MotoController::class, 'showAll']);
    Route::get('/getById/{id}', [MotoController::class, 'showById']);
    Route::post('/create', [MotoController::class, 'store']);
    Route::put('/update/{id}', [MotoController::class, 'update']);
    Route::delete('/delete/{id}', [MotoController::class, 'destroy']);
});

Route::prefix('tareas')->group(function(){
    Route::get('/getAll', [TareaController::class, 'showAll']);
    Route::get('/getById/{id}', [TareaController::class, 'showById']);
    Route::post('/create', [TareaController::class, 'store']);
    Route::put('/update/{id}', [TareaController::class, 'update']);
    Route::delete('/delete/{id}', [TareaController::class, 'destroy']);
});

Route::prefix('posts')->group(function () {
    Route::get('/getTodos',[ PostController::class, 'get']);
    Route::post('/',[ PostController::class, 'store']);
    Route::get('/{id}',[ PostController::class, 'show']);
    Route::put('/{id}',[ PostController::class, 'update']);
    Route::put('/desactivar/{id}',[ PostController::class, 'deactivate']);
    Route::put('/activar/{id}',[ PostController::class, 'activate']);
    Route::delete('/{id}',[ PostController::class, 'delete']);
});
