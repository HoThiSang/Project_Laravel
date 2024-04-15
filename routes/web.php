<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\CartController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\ChechoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminWishListController;
use App\Http\Controllers\Mail\UserSendMailController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\Admin\AminContactController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Models\Banner;

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



// Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('isLoggedIn');
Route::get('/logout', [CustomAuthController::class, 'logout']);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/filter', [ProductsController::class, 'filterByCategory'])->name('filterByCategory');
Route::get('/detail/{id}', [ProductsController::class, 'getDetail'])->name('getDetail');
Route::get('/checkout', [ChechoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [ChechoutController::class, 'checkout'])->name('checkoutPost');
Route::get('/is-checkout-success', [ChechoutController::class, 'isCheckout'])->name('isCheckoutSuccess');
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin')->middleware('isAdmin');
Route::get('/get-detail/{id}', [HomeController::class, 'getDetail'])->name('detail');
Route::get('/view-order}', [ChechoutController::class, 'getAllOrder'])->name('view-orders');
Route::get('user-profile}', [UserController::class, 'index'])->name('user-profile');
Route::post('user-profile/{id}', [UserController::class, 'updateUser'])->name('update-user-profile');
Route::post('user-profile/{id}', [UserController::class, 'updateUser'])->name('update-user-profile');


Route::post('/add-to-cart/{id}', [CartController::class, 'store'])->name('addtocart');

Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('showtocart');

Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/add-to-wishlist', [WishlistController::class, 'add'])->name('addToWishlist');
//
Route::get('/contact-page', [ContactController::class, 'index'])->name('contact-page');

Route::post('/send-mail-to', [UserSendMailController::class, 'sendEmail'])->name('sendEmail');

Auth::routes();


Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/dashboard', function () {
                return view('admin.dashboard');
        });
        Route::get('/admin-product', [AdminProductController::class, 'index'])->name('product-index');

        Route::get('/admin-product-detail/{id}', [AdminProductController::class, 'show'])->name('product-detail');

        Route::get('/admin-product-add', [AdminProductController::class, 'create'])->name('get-view-add-new');

        Route::post('/admin-product-add', [AdminProductController::class, 'store'])->name('create-new-product');

        Route::get('/admin-user', [AdminUserController::class, 'index'])->name('user-index');


        Route::get('/admin-product-update/{id}', [AdminProductController::class, 'edit'])->name('admin-get-update');

        Route::get('/admin-order', [AdminOrderController::class, 'showOrder'])->name('admin-order');

        Route::delete('/admin-orders-delete/{id}', [AdminOrderController::class, 'OrderDelete'])->name('admin-orders-delete');

        Route::post('order-change-status/{id}', [AdminOrderController::class, 'changeStatus'])->name('order-change-status');

        Route::patch('/orders/{id}', [AdminOrderController::class, 'OrderUpdate'])->name('orders-update');

        Route::get('/orders/{id}/edit', [AdminOrderController::class, 'OrderEdit'])->name('orders-edit');

        Route::get('/admin-wish-lists', [AdminWishListController::class, 'showWishLists'])->name('admin-wish-lists');

        Route::post('/admin-product-update/{id}', [AdminProductController::class, 'update'])->name('admin-product-update');

        Route::get('/admin-product-delete/{id}', [AdminProductController::class, 'destroy'])->name('admin-product-delete');

        // web.php
        Route::get('/admin-products-sortByPrice', [AdminProductController::class, 'sortByPriceDesc'])->name('admin-products-sortByPrice');

        Route::get('/admin-products-sortByQuantity', [AdminProductController::class, 'sortByQuantityDesc'])->name('admin-products-sortByQuantity');

        Route::post('/admin-products-search', [AdminProductController::class, 'search'])->name('admin-products-search');


        // Admin category 
        Route::get('/admin-categories', [AdminCategoryController::class, 'index'])->name('admin-categories'); // Show all cactegory

        Route::get('/admin-category-create', [AdminCategoryController::class, 'create'])->name('view-category-create'); // display view create

        Route::post('/admin-category-create', [AdminCategoryController::class, 'store'])->name('admin-category-create'); // display view create

        Route::get('/admin-category-delete/{id}', [AdminCategoryController::class, 'destroy'])->name('admin-category-destroy'); // display view create

        Route::post('/admin-category-search', [AdminCategoryController::class, 'research'])->name('admin-category-research'); // display view create
        Route::get('/admin-category-update/{id}', [AdminCategoryController::class, 'edit'])->name('admin-get-update'); // display view create
        Route::post('/admin-category-update/{id}', [AdminCategoryController::class, 'update'])->name('admin-category-update'); // display view creat
        Route::get('/admin-contact', [AminContactController::class, 'index'])->name('admin-contact'); // display view creat
        Route::get('/admin-view-contact/{id}', [AminContactController::class, 'show'])->name('admin-view-contact'); // display view creat
        Route::post('/admin-reply-contact/{id}', [UserSendMailController::class, 'replyEmail'])->name('admin-reply-contact'); // display view creat
        Route::get('/admin-contact-delete/{id}', [AminContactController::class, 'destroy'])->name('admin-contact-delete'); // display view creat

        Route::get('admin-banner', [AdminBannerController::class, 'index'])->name('admin-banner');
        Route::get('add-banner', [AdminBannerController::class, 'create'])->name('add-banner');
        Route::post('create-new-banner', [AdminBannerController::class, 'store'])->name('create-new-banner');
        Route::get('edit-banner/{id}', [AdminBannerController::class, 'edit'])->name('edit-banner');
        Route::post('update-banner/{id}', [AdminBannerController::class, 'update'])->name('update-banner');
        Route::get('delete-banner/{id}', [AdminBannerController::class, 'destroy'])->name('delete-banner');

        Route::get('admin-user', [AdminUserController::class, 'index'])->name('admin-user');
        Route::get('add-user', [AdminUserController::class, 'create'])->name('add-user');
        Route::post('create-new-user', [AdminUserController::class, 'store'])->name('create-new-user');
        Route::get('edit-user/{id}', [AdminUserController::class, 'edit'])->name('edit-user');
        Route::post('update-user/{id}', [AdminUserController::class, 'update'])->name('update-user');
        Route::get('delete-user/{id}', [AdminUserController::class, 'destroy'])->name('delete-user');
});

Route::middleware(['auth'])->group(function () {
});


