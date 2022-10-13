<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController AS HomeUser;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [HomeUser::class, 'index']);
Route::get('/daftar', [HomeUser::class, 'daftar']);
Route::post('/pesan', [HomeUser::class, 'pesan']);
Route::get('/print-tiket/{tiket_id}', [HomeUser::class, 'print_tiket']);


Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::get('admin/', [HomeController::class, 'index'])->middleware('auth');
Route::get('admin/home', [HomeController::class, 'index'])->middleware('auth')->name('home');


Route::prefix("/admin/kategori")->middleware('auth')->group(function () {
	Route::get("/", [KategoriController::class, 'index']);
	Route::get("add", [KategoriController::class, 'add']);
	Route::get("edit/{id}", [KategoriController::class, 'edit']);

	Route::post("/", [KategoriController::class, 'create']);
	Route::put("{id}", [KategoriController::class, 'update']);
	Route::delete("{id}", [KategoriController::class, 'delete']);
});

Route::prefix("/admin/pesanan")->middleware('auth')->group(function () {
	Route::get("/", [PesananController::class, 'index']);
	Route::get("/export-excel", [PesananController::class, 'export_excel']);
	Route::delete("{id}", [PesananController::class, 'delete']);
	
});

Route::prefix("/admin/tiket")->middleware('auth')->group(function () {
	Route::get("/", [TiketController::class, 'index']);
	Route::get("/check-tiket/{tiket_id}", [TiketController::class, 'check_tiket']);
	Route::put("/check-in/{tiket_id}", [TiketController::class, 'check_in']);
});

Route::prefix("/admin/user")->middleware('auth')->group(function () {
	Route::get("/", [UserController::class, 'index']);
	Route::get("add", [UserController::class, 'add']);
	Route::get("edit/{id}", [UserController::class, 'edit']);

	Route::post("/", [UserController::class, 'create']);
	Route::put("{id}", [UserController::class, 'update']);
	Route::delete("{id}", [UserController::class, 'delete']);
});
