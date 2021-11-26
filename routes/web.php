<?php

// Backend
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShipBlockController;
use App\Http\Controllers\Backend\ShipDistrictController;
use App\Http\Controllers\Backend\ShipStateController;
use App\Http\Controllers\Backend\ShipSubDistrictController;

// Frontend
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\User\WishlistController;

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
 *    ----           BACKEND          ----
 * =========================================================
 */

/**
 * ---------------------------------------------------
 *  ----         USER       ---- 
 * ---------------------------------------------------
 */
// Login
Route::group(["prefix" => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get("/login", [AdminController::class, 'loginForm']);
    Route::post("/login", [AdminController::class, 'store'])->name("admin.login");
});

// Dashboard
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard')->middleware('auth:admin');

// Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


//   ----         PROFILE       ---- 
// Show
Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');

// Edit
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');

// Update
Route::post('/admin/profile/edit', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');


//  ----         PASSWORD        ---- 
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
    Route::delete("/delete/{id}", [BrandController::class, 'deleteBrand'])->name('brand.delete');
});


/**
 * ---------------------------------------------------
 *  ----         CATEGORY        ---- 
 * ---------------------------------------------------
 */
Route::prefix('category')->group(function () {
    // view all Category
    Route::get('/view', [CategoryController::class, 'viewCategory'])->name('all.category');

    // Add new Category
    Route::post("/store", [CategoryController::class, 'storeCategory'])->name('category.store');

    // Edit Category
    Route::get("/edit/{id}", [CategoryController::class, 'editCategory'])->name('category.edit');

    // Update Category
    Route::post("/update", [CategoryController::class, 'updateCategory'])->name('category.update');

    // Delete Category
    Route::delete("/delete/{id}", [CategoryController::class, 'deleteCategory'])->name('category.delete');


    // ---- SUB CATEGORY ----
    Route::prefix('sub')->group(function () {
        // view all sub Category
        Route::get('/view', [SubCategoryController::class, 'viewSubCategory'])->name('all.subcategory');

        // Add new sub Category
        Route::post("/store", [SubCategoryController::class, 'storeSubCategory'])->name('subcategory.store');

        // Edit sub Category
        Route::get("/edit/{id}", [SubCategoryController::class, 'editSubCategory'])->name('subcategory.edit');

        // Update sub Category
        Route::post("/update", [SubCategoryController::class, 'updateSubCategory'])->name('subcategory.update');

        // Delete sub Category
        Route::delete("/delete/{id}", [SubCategoryController::class, 'deleteSubCategory'])->name('subcategory.delete');

        // get all sub Category in JSON
        Route::get("/ajax/{category_id}", [SubCategoryController::class, 'getSubCategory']);


        // ---- SUB SUB CATEGORY ----
        Route::prefix('sub')->group(function () {
            // view all sub sub Category
            Route::get('/view', [SubCategoryController::class, 'viewSubSubCategory'])->name('all.subSubCategory');

            // Add new sub sub Category
            Route::post("/store", [SubCategoryController::class, 'storeSubSubCategory'])->name('subSubCategory.store');

            // Edit sub sub Category
            Route::get("/edit/{id}", [SubCategoryController::class, 'editSubSubCategory'])->name('subSubCategory.edit');

            // Update sub sub Category
            Route::post("/update", [SubCategoryController::class, 'updateSubSubCategory'])->name('subSubCategory.update');

            // Delete sub sub Category
            Route::delete("/delete/{id}", [SubCategoryController::class, 'deleteSubSubCategory'])->name('subSubCategory.delete');

            // get all sub Category in JSON
            Route::get("/ajax/{subcategory_id}", [SubCategoryController::class, 'getSubSubCategory']);
        });
    });
});


/**
 * ---------------------------------------------------
 *  ----         PRODUCT       ---- 
 * ---------------------------------------------------
 */
Route::prefix('product')->group(function () {
    // view all Product
    Route::get('/view', [ProductController::class, 'viewProduct'])->name('all.product');

    // Add Product Page 
    Route::get('/add', [ProductController::class, 'addProduct'])->name('product.add');

    // Add new Product
    Route::post("/store", [ProductController::class, 'storeProduct'])->name('product.store');

    // Add new Product
    Route::post("/store/img", [ProductController::class, 'storeProductImg'])->name('product.storeImg');

    // Edit Product
    Route::get("/edit/{id}", [ProductController::class, 'editProduct'])->name('product.edit');

    // Update Product
    Route::post("/update", [ProductController::class, 'updateProduct'])->name('product.update');

    // Update Product Multipal Image
    Route::post("/update/image", [ProductController::class, 'updateProductImg'])->name('product.updateImg');

    // Update Product Thumbnail Image
    Route::post("/update/thumb", [ProductController::class, 'updateProductThumb'])->name('product.updateThumb');

    // Update Product Thumbnail Image
    Route::get("/update/status/{id}", [ProductController::class, 'updateProductStatus'])->name('product.updateStatus');

    // Delete Product Image
    Route::get("/delete/img/{id}", [ProductController::class, 'deleteProductImg'])->name('product.delete.img');

    // Delete Product
    Route::delete("/delete/{id}", [ProductController::class, 'deleteProduct'])->name('product.delete');
});


/**
 * ---------------------------------------------------
 *  ----         SLIDER       ---- 
 * ---------------------------------------------------
 */
Route::prefix('slider')->group(function () {
    // view all Slider
    Route::get('/view', [SliderController::class, 'viewSlider'])->name('all.slider');

    // Add new Slider
    Route::post("/store", [SliderController::class, 'storeSlider'])->name('slider.store');

    // Edit Slider
    Route::get("/edit/{id}", [SliderController::class, 'editSlider'])->name('slider.edit');

    // Update Status
    Route::get("/update/status/{id}", [SliderController::class, 'updateSliderStatus'])->name('slider.updateStatus');

    // Update Slider
    Route::post("/update/{id}", [SliderController::class, 'updateSlider'])->name('slider.update');

    // Delete Slider
    Route::delete("/delete/{id}", [SliderController::class, 'deleteSlider'])->name('slider.delete');
});


/**
 * ---------------------------------------------------
 *  ----         COUPON       ---- 
 * ---------------------------------------------------
 */
Route::prefix('coupon')->name('coupon.')->group(function () {
    // view all Coupon
    Route::get('/', [CouponController::class, 'index'])->name('index');

    // Add new Coupon
    Route::post("/store", [CouponController::class, 'store'])->name('store');

    // Edit Coupon
    Route::get("/edit/{id}", [CouponController::class, 'edit'])->name('edit');

    // Update Coupon
    Route::post("/update/{id}", [CouponController::class, 'update'])->name('update');

    // Delete Coupon
    Route::delete("/delete/{id}", [CouponController::class, 'delete'])->name('delete');
});


/**
 * ---------------------------------------------------
 *  ----         SHIPPING       ---- 
 * ---------------------------------------------------
 */
Route::prefix('shipping')->name('ship.')->group(function () {

    // ========== DIVISION ===========
    Route::prefix('state')->name('state.')->group(function () {
        // View all 
        Route::get('/', [ShipStateController::class, 'index'])->name('index');

        // Add new 
        Route::post("store", [ShipStateController::class, 'store'])->name('store');

        // Edit 
        Route::get("edit/{id}", [ShipStateController::class, 'edit'])->name('edit');

        // Update 
        Route::post("update/{id}", [ShipStateController::class, 'update'])->name('update');

        // Delete 
        Route::delete("delete/{id}", [ShipStateController::class, 'delete'])->name('delete');
    });


    // ========== DISTRICT ===========
    Route::prefix('dist')->name('dist.')->group(function () {
        // View all 
        Route::get('/', [ShipDistrictController::class, 'index'])->name('index');

        // Add new 
        Route::post("store", [ShipDistrictController::class, 'store'])->name('store');

        // Edit 
        Route::get("edit/{id}", [ShipDistrictController::class, 'edit'])->name('edit');

        // Update 
        Route::post("update/{id}", [ShipDistrictController::class, 'update'])->name('update');

        // Delete 
        Route::delete("delete/{id}", [ShipDistrictController::class, 'delete'])->name('delete');

        // Get District data according to state
        Route::get("ajax/{id}", [ShipDistrictController::class, 'getDistrict']);
    });

    // ========== SUB DISTRICT ===========
    Route::prefix('sub-dist')->name('subdist.')->group(function () {
        // View all 
        Route::get('/', [ShipSubDistrictController::class, 'index'])->name('index');

        // Add new 
        Route::post("store", [ShipSubDistrictController::class, 'store'])->name('store');

        // Edit 
        Route::get("edit/{id}", [ShipSubDistrictController::class, 'edit'])->name('edit');

        // Update 
        Route::post("update/{id}", [ShipSubDistrictController::class, 'update'])->name('update');

        // Delete 
        Route::delete("delete/{id}", [ShipSubDistrictController::class, 'delete'])->name('delete');

        // Get District data according to state
        Route::get("ajax/{id}", [ShipSubDistrictController::class, 'getSubDistrict']);
    });

    // ==========  BLOCK ===========
    Route::prefix('block')->name('block.')->group(function () {
        // View all 
        Route::get('/', [ShipBlockController::class, 'index'])->name('index');

        // Add new 
        Route::post("store", [ShipBlockController::class, 'store'])->name('store');

        // Edit 
        Route::get("edit/{id}", [ShipBlockController::class, 'edit'])->name('edit');

        // Update 
        Route::post("update/{id}", [ShipBlockController::class, 'update'])->name('update');

        // Delete 
        Route::delete("delete/{id}", [ShipBlockController::class, 'delete'])->name('delete');
    });
});


// ====================================================================================================================================================================
// ====================================================================================================================================================================

/**
 * ========================================================
 *    ----           FRONTEND          ----
 * ========================================================
 */

//  ---- Jetstream ----
require_once __DIR__ . '/jetstream.php';

// Home
Route::get("/", [IndexController::class, 'index'])->name('index');

/**
 * ---------------------------------------------------
 *  ----         USER       ---- 
 * ---------------------------------------------------
 */
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', compact('user'));
})->name('dashboard');


//    ----         PROFILE       ---- 
// Logout
Route::get("/user/logout", [IndexController::class, 'userLogout'])->name('user.logout');

// User Profile Show
Route::get("/user/profile", [IndexController::class, 'userProfile'])->name('user.profile');

// User Profile Update
Route::post("/user/profile/store", [IndexController::class, 'userProfileStore'])->name('user.profile.store');


//   ----         PASSWORD       ---- 
// Change Password
Route::get("/user/change/password", [IndexController::class, 'userChangePassword'])->name('change.password');

// Update Password
Route::post("/user/password/update", [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');


/**
 * ---------------------------------------------------
 *  ----         LANGUAGE       ---- 
 * ---------------------------------------------------
 */
Route::prefix('language')->name('language.')->group(function () {
    // Hindi Language
    Route::get("hindi", [LanguageController::class, 'hindi'])->name('hindi');

    //  English Language
    Route::get("english", [LanguageController::class, 'english'])->name('english');
});


/**
 * ---------------------------------------------------
 *  ----         PRODUCT       ---- 
 * ---------------------------------------------------
 */
Route::prefix('product')->name('product.')->group(function () {
    // Product Details page
    Route::get('details/{id}/{slug}', [FrontendProductController::class, 'productDetails'])->name('details');

    // Product Tag page
    Route::get('tag/{tag}', [FrontendProductController::class, 'tagWiseProduct'])->name('tag');

    // Product sub category wise data
    Route::get('sub-cat/{subcat}/{slug}', [FrontendProductController::class, 'subCatWiseProduct'])->name('subCategory');

    // Product sub sub category wise data
    Route::get('sub-sub-cat/{sub_subcat}/{slug}', [FrontendProductController::class, 'subSubCatWiseProduct'])->name('subSubCategory');

    // Product view modal ajax
    Route::post('ajax', [FrontendProductController::class, 'productAjax']);
});

/**
 * ---------------------------------------------------
 *  ----         CART       ---- 
 * ---------------------------------------------------
 */
Route::prefix('cart')->name('cart.')->group(function () {
    // Show my cart page
    Route::get('/', [CartController::class, 'index'])->name('index');

    // --- AJAX REQUEST ---
    // Add to cart using ajax
    Route::post('store', [CartController::class, 'addToCart']);

    // Get mini Cart data using ajax 
    Route::get('get-product', [CartController::class, 'getCartProduct']);

    // Delete mini Cart data using ajax 
    Route::post('delete', [CartController::class, 'deleteCart']);

    // Increament Quantity using ajax
    Route::post('increment', [CartController::class, 'increment']);

    // Decreament Quantity using ajax
    Route::post('decrement', [CartController::class, 'decrement']);
});


/**
 * ---------------------------------------------------
 *  ----         WISHLIST       ---- 
 * ---------------------------------------------------
 */
Route::prefix('wishlist')->name('wishlist.')->group(function () {
    // show wishlist page
    Route::get('/', [WishlistController::class, 'index'])->name('index');

    // get Wishlist using ajax
    Route::get('/get', [WishlistController::class, 'getWishlistProduct']);

    // Add to Wishlist using ajax
    Route::post('add', [WishlistController::class, 'addToWishlist']);

    // Remove from Wishlist using ajax
    Route::post('delete', [WishlistController::class, 'removeWishlist']);
});
