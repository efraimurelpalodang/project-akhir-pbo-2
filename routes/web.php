<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index']);
Route::view('/dashboard','dashboard');
Route::view('/pembeli', 'pembeli.index')->name('pembeli.index');
Route::view('/superadmin/user', 'superadmin.user.index')->name('superadmin.user.index');
Route::view('/superadmin/peran', 'superadmin.peran.index')->name('superadmin.peran.index');
Route::view('/barang', 'barang.index')->name('barang.index');
Route::view('/satuan', 'satuan.index')->name('satuan.index');
