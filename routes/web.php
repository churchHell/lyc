<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    CategoryController as AdminCategoryController,
    IndexController as AdminIndexController,
    ItemController as AdminItemController,
    OrderController,
    PageController as AdminPageController,
    PropertyController,
    SettingController,
    UnitController
};
use App\Http\Controllers\{
	Auth\LoginController,
    AuthController,
    CartController,
    CategoryController,
    IndexController,
    ItemController,
    PageController
};

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

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminIndexController::class, 'index'])->name('index');
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories');
    Route::get('/categories/{category:slug}', [AdminCategoryController::class, 'show'])->name('categories.show');
    Route::resource('/items', AdminItemController::class)->only('index', 'edit');
    Route::get('/items/create/{category}', [AdminItemController::class, 'create'])->name('items.create')->where('category', '[0-9]+');
    Route::resource('/orders', OrderController::class)->only('index');
    Route::resource('/pages', AdminPageController::class)->only('index', 'create', 'edit');
    Route::resource('/properties', PropertyController::class)->only('index', 'create');
    Route::resource('/settings', SettingController::class)->only('index');
    Route::resource('/units', UnitController::class)->only('index');
});

Route::middleware('auth')->group(function () {
    Route::resource('/cart', CartController::class)->only('index');
    Route::get('/account', [AuthController::class, 'account'])->name('account');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Auth::routes(['except' => 'logout', 'verify' => true]);
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/page/{page:slug}', [PageController::class, 'show'])->name('page.index');
// Route::get('/login', [AuthController::class, 'login'])->name('login');
// Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/{slug}', [CategoryController::class, 'index'])->name('category.index')->where('slug', '[0-9A-Za-z\-]+');
Route::get('/{category}/{item}', [ItemController::class, 'show'])->name('item.show')->where('category', '[0-9A-Za-z\-]+')->where('item', '[0-9A-Za-z\-]+');
Route::resource('/cart', CartController::class)->only('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');