<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//route pegawai untuk mengalihkan ke tampilan utama web
Route::get('/pegawai',[EmployeeController::class,'index'])->name('pegawai');
//route tambahpegawai untuk mengalihkan ke form tambah pegawai
Route::get('/tambahpegawai',[EmployeeController::class,'tambahpegawai'])->name('tambahpegawai');
//route insert data untuk mengirimkan data dari form tambah pegawai ke database
Route::post('/insertdata',[EmployeeController::class,'insertdata'])->name('insertdata');
//route tampilkan data untuk mengalihkan halaman ke form pengeditan atau update data
Route::get('/tampilkandata/{id}',[EmployeeController::class,'tampilkandata'])->name('tampilkandata');
//route update data untuk mengirimkan form hasil pengeditan ke database
Route::post('/updatedata/{id}',[EmployeeController::class,'updatedata'])->name('updatedata');
//route delete untuk menghapus data yang ada pada database
Route::get('/delete/{id}',[EmployeeController::class,'delete'])->name('delete');
//route untuk export PDF
Route::get('/exportpdf',[EmployeeController::class,'exportpdf'])->name('exportpdf');
//route untuk export Excel
Route::get('/exportexcel',[EmployeeController::class,'/exportexcel'])->name('/exportexcel');

