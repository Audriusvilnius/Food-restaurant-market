<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OvnerController as O;
use App\Http\Controllers\FoodController as D;
use App\Http\Controllers\RestaurantController as R;
use App\Http\Controllers\OrderController as B;
use App\Http\Controllers\CityController as City;
use App\Http\Controllers\CategoryController as Category;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController as Role;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\ProductController as Product;

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
    Route::get('/shiped', [B::class, 'shiped'])->name('shiped')->middleware('roles:A|M');
    Route::put('/edit/{order}', [B::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{order}', [B::class, 'destroy'])->name('delete')->middleware('roles:A|M');
    Route::post('/staus/{order}', [B::class, 'status'])->name('status')->middleware('roles:A|M');
});

Route::prefix('customer/{id}/order')->name('order-')->group(function () {
    Route::get('/', [B::class, 'myorders'])->name('myorders')->middleware('roles:C');
});

Route::get('/', [F::class, 'home'])->name('start');
Route::post('/rate', [F::class, 'rate'])->name('update-rate')->middleware('roles:A|M|C');

Route::post('/city', [F::class, 'city'])->name('select-city');
Route::get('/city', [F::class, 'getCity'])->name('get-city');
Route::get('/reviews', [F::class, 'reviews'])->name('update-reviews');
Route::post('/add-basket', [F::class, 'addToBasket'])->name('add-basket');
Route::get('/basket', [F::class, 'viewBasket'])->name('view-basket');
Route::post('/basket', [F::class, 'updateBasket'])->name('update-basket');
Route::get('/confirm', [F::class, 'confirmBasket'])->name('confirm-basket')->middleware('roles:A|M|C');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|M|C');
Route::get('/list/{restaurant}', [F::class, 'listRestaurants'])->name('list-restaurant');

Route::get('/list/category/{category}', [F::class, 'listCategory'])->name('list-category');

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

Route::prefix('admin/city')->name('city-')->group(function () {
    Route::get('/', [City::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [City::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [City::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/show/{city}', [City::class, 'show'])->name('show')->middleware('roles:A|M');
    Route::get('/edit/{city}', [City::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{city}', [City::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{city}', [City::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Route::prefix('admin/category')->name('category-')->group(function () {
    Route::get('/', [Category::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [Category::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [Category::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/show/{category}', [Category::class, 'show'])->name('show')->middleware('roles:A|M');
    Route::get('/edit/{category}', [Category::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{category}', [Category::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{category}', [Category::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Auth::routes();
//Auth::routes(['register'=> false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', Role::class);
    Route::resource('users', User::class);
    Route::resource('products', Product::class);
});


Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::prefix('list')->group(function () {
    Route::get('/category/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/restaurants/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/foods/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/category/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/foods/edit/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/ovner/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/order/ticket/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/category/edit/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/restaurants/edit/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/city/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/city/edit/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/ovner/edit/language/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
});
Route::get('/customer/{id}/language/{locale}', function ($id, $locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
