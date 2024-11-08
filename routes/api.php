<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RoleAndFungsiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TindakLanjutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataDownloadController;

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
Route::get('Kategori/{id}', [LaporanController::class, 'showKategoriID']);
Route::get('Lokasi', [LaporanController::class, 'showLokasi']);
Route::get('Lokasi/{id}', [LaporanController::class, 'showLokasiID']);
Route::get('CLSR', [LaporanController::class, 'showCLSR']);
Route::get('CLSR/{id}', [LaporanController::class, 'showCLSRID']);

Route::get('TipeObservasiT', [TindakLanjutController::class, 'showTipeObservasi']);
Route::get('TipeObservasiT/{id}', [TindakLanjutController::class, 'showTipeObservasiID']);
Route::get('KategoriT', [TindakLanjutController::class, 'showKategori']);
Route::get('KategoriT/{id}', [TindakLanjutController::class, 'showKategoriID']);
Route::get('LokasiT', [TindakLanjutController::class, 'showLokasi']);
Route::get('LokasiT/{id}', [TindakLanjutController::class, 'showLokasiID']);
Route::get('CLSRT', [TindakLanjutController::class, 'showCLSR']);
Route::get('CLSRT/{id}', [TindakLanjutController::class, 'showCLSRID']);

Route::get('laporans', [LaporanController::class, 'index']);
Route::get('laporans/month', [LaporanController::class, 'index2']);
Route::get('laporans/week', [LaporanController::class, 'index3']);
Route::get('laporans/{id}', [LaporanController::class, 'show']);
Route::post('laporans', [LaporanController::class, 'store']);

Route::get('tindaklanjuts', [TindakLanjutController::class, 'index']);
Route::get('tindaklanjuts/month', [TindakLanjutController::class, 'index2']);
Route::get('tindaklanjuts/week', [TindakLanjutController::class, 'index3']);
Route::get('tindaklanjuts/{id}', [TindakLanjutController::class, 'show']);
Route::post('/tindaklanjuts', [TindakLanjutController::class, 'store']);
Route::put('/tindaklanjut/{id}/status', [TindaklanjutController::class, 'updateStatusAndTanggalAkhir']);
Route::get('/download-data-xlsx-month', [DataDownloadController::class, 'downloadXlsxMonth']);
Route::get('/download-data-xlsx-week', [DataDownloadController::class, 'downloadXlsxWeek']);