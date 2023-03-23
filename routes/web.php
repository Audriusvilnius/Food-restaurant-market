<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OvnerController as O;
use App\Http\Controllers\FoodController as D;
use App\Http\Controllers\RestaurantController as R;
use App\Http\Controllers\OrderController as B;

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

Route::prefix('admin/order')->name('order-')->group(function () {
    Route::get('/', [B::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::put('/edit/{order}', [B::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{order}', [B::class, 'destroy'])->name('delete')->middleware('roles:A|M');
    Route::post('/ticket/{order}', [B::class, 'ticket'])->name('ticket')->middleware('roles:A|M');
});

Route::get('/', [F::class, 'home'])->name('start');
    Route::post('/rate', [F::class, 'rate'])->name('update-rate')->middleware('roles:A|M|C');
    Route::post('/add-basket', [F::class, 'addToBasket'])->name('add-basket');
    Route::get('/basket', [F::class, 'viewBasket'])->name('view-basket');
    Route::post('/basket', [F::class, 'updateBasket'])->name('update-basket');
    Route::get('/confirm', [F::class, 'confirmBasket'])->name('confirm-basket')->middleware('roles:A|M|C');
    Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|M|C');
    Route::get('/list/{restaurant}', [F::class, 'listRestaurants'])->name('list-restaurant');

Route::prefix('admin/ovner')->name('ovner-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [O::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [O::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{ovner}', [O::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{ovner}', [O::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{ovner}', [O::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Route::prefix('admin/restaurants')->name('restaurants-')->group(function () {
    Route::get('/', [R::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [R::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [R::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/show/{restaurant}', [R::class, 'show'])->name('show');
    Route::get('/edit/{restaurant}', [R::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{restaurant}', [R::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{restaurant}', [R::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Route::prefix('admin/foods')->name('foods-')->group(function () {
    Route::get('/', [D::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [D::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [D::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/show/{food}', [D::class, 'show'])->name('show')->middleware('roles:A|M');
    Route::get('/edit/{food}', [D::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{food}', [D::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{food}', [D::class, 'destroy'])->name('delete')->middleware('roles:A|M');
    Route::get('/rest-title', [D::class, 'copyRestTitle'])->name('rest_title')->middleware('roles:A|M');
});

Auth::routes();
//Auth::routes(['register'=> false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');