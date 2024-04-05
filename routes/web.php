<?php

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
Route::get('/contact-page', [HomeController::class, 'contact'])->name('contact-page');
Route::get('/login', [CustomAuthController::class, 'login'])->name('login')->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration')->middleware('alreadyLoggedIn');
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
Route::get('admin/dashboard', [AdminController::class, 'admin'])->name('admin')->middleware('isAdmin');
Route::get('/get-detail/{id}', [HomeController::class, 'getDetail'])->name('detail');
Route::get('/view-order/{id?}', [ChechoutController::class, 'getAllOrder'])->name('view-orders');
Route::get('user-profile/{id?}', [UserController::class, 'index'])->name('user-profile');
Route::post('user-profile/{id}', [UserController::class, 'updateUser'])->name('update-user-profile');
Route::post('user-profile/{id}', [UserController::class, 'updateUser'])->name('update-user-profile');


Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/admin-user', [AdminUserController::class, 'index'])->name('user-index');
});


Route::post('/add-to-cart/{id}', [CartController::class, 'store'])->name('addtocart');

Route::get('/shopping-cart',[CartController::class, 'showCart'])->name('showtocart');

Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::prefix('admin')->name('admin.')->group(function(){

        Route::get('/admin-product', [AdminProductController::class, 'index'])->name('product-index');

        Route::get('/admin-product-detail/{id}', [AdminProductController::class, 'show'])->name('product-detail');
        
        Route::get('/admin-product-add', [AdminProductController::class, 'create'])->name('get-view-add-new');

        Route::post('/admin-product-add', [AdminProductController::class, 'store'])->name('create-new-product');
});



