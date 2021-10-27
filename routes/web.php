<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

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



/**
 * =========================================================
 *    ----           ADMIN          ----
 * =========================================================
 */

// Login
Route::group(["prefix" => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get("/login", [AdminController::class, 'loginForm']);
    Route::post("/login", [AdminController::class, 'store'])->name("admin.login");
});

// Dashboard
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

// Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


/**
 * ---------------------------------------------------
 *  ----         PROFILE       ---- 
 * ---------------------------------------------------
 */
// Show
Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');

// Edit
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');

// Update
Route::post('/admin/profile/edit', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');


/**
 * ---------------------------------------------------
 *  ----         PASSWORD        ---- 
 * ---------------------------------------------------
 */
// Change Password
Route::get("/admin/change/password", [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');

// Update Password
Route::post("/update/change/password", [AdminProfileController::class, 'adminUpdateChangePassword'])->name('update.change.password');


/**
 * ---------------------------------------------------
 *  ----         BRANDS        ---- 
 * ---------------------------------------------------
 */
Route::prefix('brand')->group(function () {
    // view all brands
    Route::get('/view', [BrandController::class, 'viewBrand'])->name('all.brand');

    // Add new Brand
    Route::post("/store", [BrandController::class, 'storeBrand'])->name('brand.store');

    // Edit Brand
    Route::get("/edit/{id}", [BrandController::class, 'editBrand'])->name('brand.edit');

    // Update Brand
    Route::post("/update", [BrandController::class, 'updateBrand'])->name('brand.update');

    // Delete Brand
    Route::get("/delete/{id}", [BrandController::class, 'deleteBrand'])->name('brand.delete');
});



// -----------------------------------------------------------------------------------------------------------------------------------------------------------


/**
 * ========================================================
 *    ----           USER          ----
 * ========================================================
 */

//  ---- Jetstream ----
require_once __DIR__ . '/jetstream.php';


//  Dashboard
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', compact('user'));
})->name('dashboard');

// Home
Route::get("/", [IndexController::class, 'index'])->name('index');


// ---- Profile ----

// Logout
Route::get("/user/logout", [IndexController::class, 'userLogout'])->name('user.logout');

// User Profile Show
Route::get("/user/profile", [IndexController::class, 'userProfile'])->name('user.profile');

// User Profile Update
Route::post("/user/profile/store", [IndexController::class, 'userProfileStore'])->name('user.profile.store');


// -------  PASSWORD-------

// Change Password
Route::get("/user/change/password", [IndexController::class, 'userChangePassword'])->name('change.password');

// Update Password
Route::post("/user/password/update", [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');
