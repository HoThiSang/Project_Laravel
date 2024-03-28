<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ChechoutController;


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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/category', function () {
    return view('users/category');
});

Route::get('/register', function () {
    return view('users/register');
})->name('register');


Route::get('/login', function () {
    return view('users/login');
})->name('login');

Route::get('/contact', function(){
    return view('users/contact');
})->name('contact');

Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard']);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/filter', [ProductsController::class, 'filterByCategory'])->name('filterByCategory');

Route::get('/detail/{id}', [ProductsController::class, 'getDetail'])->name('getDetail');

Route::get('/checkout',[ChechoutController::class, 'index'])->name('checkout');

Route::post('/checkout',[ChechoutController::class, 'checkout'])->name('checkoutPost');

Route::get('/is-checkout-success',[ChechoutController::class, 'isCheckout'])->name('isCheckoutSuccess');
