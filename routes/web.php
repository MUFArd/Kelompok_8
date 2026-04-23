<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;

Route::get('/', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/peserta', [PendaftaranController::class, 'list'])->name('pendaftaran.list');
Route::patch('/peserta/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
