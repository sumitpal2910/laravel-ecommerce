<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

/**
 * ------------------- ADMIN ----------------------------
 */
Route::group(["prefix" => 'admin', 'middleware' => ['admin:admin']], function () {
    // Login
    Route::get("/login", [AdminController::class, 'loginForm']);
    Route::post("/login", [AdminController::class, 'store'])->name("admin.login");
});

// Dashboard
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');



/**
 * ----------------------- USER --------------------------------------------
 */
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');