<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RoleAndFungsiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TindakLanjutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
Route::get('roles/{id}', [RoleAndFungsiController::class, 'showRole']);
Route::get('fungsi/{id}', [RoleAndFungsiController::class, 'showFungsi']);

Route::get('TipeObservasi', [LaporanController::class, 'showTipeObservasi']);
Route::get('TipeObservasi/{id}', [LaporanController::class, 'showTipeObservasiID']);
Route::get('Kategori', [LaporanController::class, 'showKategori']);
Route::get('Lokasi', [LaporanController::class, 'showLokasi']);
Route::get('CLSR', [LaporanController::class, 'showCLSR']);

Route::get('laporans', [LaporanController::class, 'index']);
Route::get('laporans/{id}', [LaporanController::class, 'show']);
Route::post('laporans', [LaporanController::class, 'store']);

Route::get('tindaklanjuts', [TindakLanjutController::class, 'index']);
Route::get('tindaklanjuts/{id}', [TindakLanjutController::class, 'show']);
Route::post('tindaklanjuts', [TindakLanjutController::class, 'store']);
Route::put('/tindaklanjut/{id}/status', [TindaklanjutController::class, 'updateStatusAndTanggalAkhir']);