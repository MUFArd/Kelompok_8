<?php

use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\GuruController;
use App\http\Controllers\API\JurusanController;
use App\http\Controllers\API\KelasController;
use App\http\Controllers\API\MapelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kelas', [SiswaController::class, 'getdata']);

Route::get('/jurusan', [GuruController::class, 'getdata']);

route::get('/pendaftara', [JurusanController::class, 'getdata']);
