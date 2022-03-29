<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search/cie10', [\App\Http\Controllers\Api\SearchController::class, 'cie10'])
    ->name('search-cie10');
Route::get('/search/cups', [\App\Http\Controllers\Api\SearchController::class, 'cups'])
    ->name('search-cups');
Route::get('/search/cums', [\App\Http\Controllers\Api\SearchController::class, 'cums'])
    ->name('search-cums');

/*Buscador general de ubicación*/
Route::get('/departamentos/{pais:id_pais}',[App\Http\Controllers\buscador\UbicacionController::class,'departamentos'])
    ->name('departamentos');
Route::get('/provincias/{departamento:id_departamento}',[App\Http\Controllers\buscador\UbicacionController::class,'provincias'])
    ->name('provincias');
Route::get('/ciudades/{provincia:id_provincia}',[App\Http\Controllers\buscador\UbicacionController::class,'ciudades'])
    ->name('ciudades');

