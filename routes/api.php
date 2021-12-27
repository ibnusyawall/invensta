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

Route::group(['prefix' => 'v1'], function() {
    Route::post('auth/login', 'API\AuthController@login');
    Route::post('auth/pegawai/login', 'API\AuthController@loginPegawai');
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function() {
    Route::resource('jenis', 'API\JenisController');
    Route::resource('ruang', 'API\RuangController');
    Route::resource('level', 'API\LevelController');
    Route::resource('petugas', 'API\PetugasController');
    Route::resource('inventaris', 'API\InventarisController');
    Route::resource('pegawai', 'API\PegawaiController');
    Route::resource('peminjaman', 'API\PeminjamanController');
    Route::resource('detail-pinjam', 'API\DetailPinjamController');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
