<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\NinjaController;

Route::get('/', function () {
    return redirect('/dojos');
});

Route::get('/dojos', [DojoController::class, 'index']);

Route::get('/dojos/create', [DojoController::class, 'create']);
Route::post('/dojos', [DojoController::class, 'store']);

Route::get('/ninjas/create', [NinjaController::class, 'create']);
Route::post('/ninjas', [NinjaController::class, 'store']);

Route::get('/dojos/{dojo}', [DojoController::class, 'show']);
Route::get('/ninjas/{ninja}', [NinjaController::class, 'show']);
