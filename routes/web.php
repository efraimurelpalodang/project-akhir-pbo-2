<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::view('/dashboard','dashboard')->name('dashboard')->middleware('auth');
Route::view('/salesOrder','salesOrder.index')->name('salesOrder.index');
Route::view('/surat','surat-jalan.create')->name('suratJalan.create');
Route::view('/listSJ','surat-jalan.index')->name('suratJalan.index');
Route::view('/SOMasuk','salesOrder.masuk')->name('salesOrder.masuk');
Route::view('/pembeli', 'pembeli.index')->name('pembeli.index');
Route::view('/superadmin/user', 'superadmin.user.index')->name('superadmin.user.index');
Route::view('/superadmin/peran', 'superadmin.peran.index')->name('superadmin.peran.index');
Route::view('/barang', 'barang.index')->name('barang.index');
Route::view('/satuan', 'satuan.index')->name('satuan.index');
