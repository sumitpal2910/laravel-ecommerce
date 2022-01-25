<?php

// Backend
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\Blog\BlogPostCategoryController;
use App\Http\Controllers\Backend\Blog\BlogPostController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
<<<<<<< HEAD
=======
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ReviewController as BackendReviewController;
>>>>>>> 554f03b3f5d3736d4c17543c52f74ceb4331dd3d
use App\Http\Controllers\Backend\ShipDistrictController;
use App\Http\Controllers\Backend\ShipStateController;
use App\Http\Controllers\Backend\Setting\SiteSettingController;
use App\Http\Controllers\Backend\Setting\SeoController;

// Frontend
use App\Http\Controllers\Frontend\BlogPostController as FrontendBlogPostController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ReviewController;
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
 *  ----         ADMIN      ----
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


/**
 * ---------------------------------------------------
 *  ----         ADMIN PROFILE        ----
 * ---------------------------------------------------
 */
Route::prefix('admin')->name('admin.')->group(function () {
    // Show
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('profile');

    // Edit
    Route::get('profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('profile.edit');

    // Update
    Route::post('profile/edit', [AdminProfileController::class, 'adminProfileUpdate'])->name('profile.update');

    // Show all users
    Route::get('users', [AdminProfileController::class, 'users'])->name('users');
});

//  ----         PASSWORD        ----
// Change Password
Route::get("/admin/change/password", [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');

// Update Password
Route::post("/update/change/password", [AdminProfileController::class, 'adminUpdateChangePassword'])->name('update.change.password');


Route::get('info', function () {
    return phpinfo();
});

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
});

/**
 * ---------------------------------------------------
<<<<<<< HEAD
 *  ----         SHIPPING       ---- 
=======
 *  ----         ORDERS      ----
>>>>>>> 554f03b3f5d3736d4c17543c52f74ceb4331dd3d
 * ---------------------------------------------------
 */
Route::prefix("order")->name("order.")->group(function () {
    // Show Order
    Route::get("show/{id}", [BackendOrderController::class, 'show'])->name("show");
<<<<<<< HEAD

    // Pending Order
    Route::get("pending", [BackendOrderController::class, "pending"])->name("pending");

    // Confirmed Order
    Route::get("confirmed", [BackendOrderController::class, "confirmed"])->name("confirmed");

    // Processing Order
    Route::get("processing", [BackendOrderController::class, "processing"])->name("processing");

    // Picked Order
    Route::get("picked", [BackendOrderController::class, "picked"])->name("picked");
});
=======
>>>>>>> 554f03b3f5d3736d4c17543c52f74ceb4331dd3d

    // Pending Order
    Route::get("pending", [BackendOrderController::class, "pending"])->name("pending");

    // Confirmed Order
    Route::get("confirmed", [BackendOrderController::class, "confirmed"])->name("confirmed");

    // Processing Order
    Route::get("processing", [BackendOrderController::class, "processing"])->name("processing");

    // Picked Order
    Route::get("picked", [BackendOrderController::class, "picked"])->name("picked");

    // Shipped Order
    Route::get("shipped", [BackendOrderController::class, "shipped"])->name("shipped");

    // Delivered Order
    Route::get("delivered", [BackendOrderController::class, "delivered"])->name("delivered");

    // Cancel Order
    Route::get("cancel", [BackendOrderController::class, "cancel"])->name("cancel");

    // Update Order Status
    Route::get('status/update/{id}/{status}', [BackendOrderController::class, 'updateStatus'])->name('updateStatus');

    // Download order invoice
    Route::get('invoice/{id}', [BackendOrderController::class, "invoice"])->name("invoice");
});

/**
 * ---------------------------------------------------
 *  ----         REPORTS      ----
 * ---------------------------------------------------
 */
Route::prefix('report')->name('report.')->group(function () {
    // show report
    Route::get('/', [ReportController::class, 'index'])->name('index');

    // get report by date
    Route::post('date', [ReportController::class, 'date'])->name('date');

    // get report by month
    Route::post('month', [ReportController::class, 'month'])->name('month');

    // get report by year
    Route::post('year', [ReportController::class, 'year'])->name('year');
});

/**
 * ---------------------------------------------------
 *  ----         BLOG POSTS      ----
 * ---------------------------------------------------
 */
Route::prefix('admin/blog')->name('admin.blog.')->group(function () {

    // Index
    Route::get('/', [BlogPostController::class, 'index'])->name('index');

    // Create
    Route::get('create', [BlogPostController::class, 'create'])->name('create');

    // store
    Route::post('store', [BlogPostController::class, 'store'])->name('store');

    // Edit
    Route::get('{id}/edit', [BlogPostController::class, 'edit'])->name('edit');

    // Update
    Route::put('update/{id}', [BlogPostController::class, 'update'])->name('update');

    // Delete
    Route::delete('{id}/delete', [BlogPostController::class, 'delete'])->name('delete');

    // Category
    Route::prefix('category')->name('cat.')->group(function () {
        // Index
        Route::get('/', [BlogPostCategoryController::class, 'index'])->name('index');

        // store
        Route::post('store', [BlogPostCategoryController::class, 'store'])->name('store');

        // Edit
        Route::get('{id}/edit', [BlogPostCategoryController::class, 'edit'])->name('edit');

        // Update
        Route::put('update/{id}', [BlogPostCategoryController::class, 'update'])->name('update');

        // Delete
        Route::delete('{id}/delete', [BlogPostCategoryController::class, 'delete'])->name('delete');
    });
});

/**
 * ---------------------------------------------------
 *  ----         SETTING      ----
 * ---------------------------------------------------
 */
Route::prefix('setting')->name('setting.')->group(function () {

    // Site
    Route::prefix('site')->name('site.')->group(function () {
        // Index
        Route::get('/', [SiteSettingController::class, 'index'])->name('index');

        // Update
        Route::put('update/{id}', [SiteSettingController::class, 'update'])->name('update');
    });

    // Seo
    Route::prefix('seo')->name('seo.')->group(function () {
        // Index
        Route::get('/', [SeoController::class, 'index'])->name('index');

        // Update
        Route::put('update/{id}', [SeoController::class, 'update'])->name('update');
    });
});


/**
 * ---------------------------------------------------
 *  ----         RETURN     ----
 * ---------------------------------------------------
 */
Route::prefix('admin/return')->name('admin.return.')->group(function () {
    // Index
    Route::get('/', [ReturnController::class, 'index'])->name('index');

    // Request
    Route::get('request/', [ReturnController::class, 'request'])->name('request');

    // Approve
    Route::post('approve/{id}', [ReturnController::class, 'approve'])->name('approve');
});

/**
 * ---------------------------------------------------
 *  ----         REVIEW       ----
 * ---------------------------------------------------
 */
Route::prefix('admin/review')->name('admin.review.')->group(function () {
    // Pending
    Route::get('pending', [BackendReviewController::class, 'pending'])->name('pending');

    // Published
    Route::get('published', [BackendReviewController::class, 'published'])->name('published');

    Route::post('update/{id}', [BackendReviewController::class, 'update'])->name('update');
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
Route::prefix("user")->name("user.")->group(function () {
    // Logout
    Route::get("logout", [IndexController::class, 'userLogout'])->name('logout');

    // User Profile Show
    Route::get("profile", [IndexController::class, 'userProfile'])->name('profile');

    // User Profile Update
    Route::post("profile/store", [IndexController::class, 'userProfileStore'])->name('profile.store');
});


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

    // Apply Coupon
    Route::post('coupon/apply', [CartController::class, 'couponApply']);

    // Get Calculated price
    Route::get('coupon/cal', [CartController::class, 'couponCalculation']);

    // Remove Coupon
    Route::get('coupon/remove', [CartController::class, 'couponRemove']);

    // Coupon Update
    Route::get('coupon/update', [CartController::class, 'couponUpdate']);
});

/**
 * ---------------------------------------------------
 *  ----         CHECKOUT       ----
 * ---------------------------------------------------
 */
Route::prefix("checkout")->name("checkout.")->group(function () {
    // Index page
    Route::get("/", [CheckoutController::class, 'index'])->name("index");

    // Store page
    Route::post("store", [CheckoutController::class, 'store'])->name("store");

    // Get District data according to state
    Route::get("dist/ajax/{id}", [CheckoutController::class, 'getDistrict']);
});

/**
 * ---------------------------------------------------
 *  ----         STRIPE       ----
 * ---------------------------------------------------
 */
Route::prefix("payment")->name("payment.")->group(function () {
    // Stripe
    Route::post("stripe", [PaymentController::class, 'stripe'])->name("stripe");

    // Cash
    Route::post("cash", [PaymentController::class, 'cash'])->name("cash");
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

/**
 * ---------------------------------------------------
 *  ----         ORDER       ----
 * ---------------------------------------------------
 */
Route::prefix("user/order")->name("user.order.")->group(function () {
    // Index
    Route::get("/", [OrderController::class, 'index'])->name("index");

    // Show
    Route::get("show/{id}", [OrderController::class, 'show'])->name("show");

    // Invoice
    Route::get("invoice/{id}", [OrderController::class, 'invoice'])->name("invoice");

    // Return order
    Route::post('return/{id}', [OrderController::class, 'return'])->name('return');

    // Show all return order
    Route::get('return', [OrderController::class, 'showReturnOrder'])->name('return.list');

    // Show all return order
    Route::get('cancel', [OrderController::class, 'showCancelOrder'])->name('cancel.list');
});

/**
 * ---------------------------------------------------
 *  ----         BLOG       ----
 * ---------------------------------------------------
 */
Route::prefix('blog')->name('blog.')->group(function () {
    // Index
    Route::get('/', [FrontendBlogPostController::class, 'index'])->name('index');

    // Show
    Route::get('show/{id}/{slug}', [FrontendBlogPostController::class, 'show'])->name('show');

    // show by category
    Route::get('category/{id}/{slug}', [FrontendBlogPostController::class, 'category'])->name('category');
});

/**
 * ---------------------------------------------------
 *  ----         REVIEW       ----
 * ---------------------------------------------------
 */
Route::prefix('review')->name('review.')->group(function () {
    // Store
    Route::post('store', [ReviewController::class, 'store'])->name('store');
});
