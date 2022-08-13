<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\OrderHomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxLoginController;
use App\Http\Controllers\promotionControllers;

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

Route::get('test-email', [HomeController::class, 'testEmail']);
Route::get('/', 'HomeController@index')->name('home.index'); //route(home.index)
Route::get('/language/{lang}', [HomeController::class, 'lang'])->name('home.lang');;
Route::get('/shop', 'HomeController@shop')->name('home.shop');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admincontroller@index')->name('admin.index');
    Route::get('order', [OrderController::class, 'history'])->name('order.index');
    Route::get('order/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');
    Route::put('order/status/{order}', [OrderController::class, 'status'])->name('order.status');
    Route::put('order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/changepassword', 'Usercontroller@changepasswordform')->name('user.changepassword');
    Route::post('/changepassword', 'Usercontroller@changepassword')->name('user.changepassword');
    Route::get('/exportExcel', [Admincontroller::class, 'exportExcel'])->name('admin.exportExcel');

    Route::resources([
        'category' => 'CategoryController',
        'product' => 'ProductController',
        'guest' => 'GuestController',
        'order' => 'OrderController',
    ]);
    Route::get('/promotion', [promotionControllers::class, 'index'])->name('admin.promotion')->middleware('only.role');
    Route::get('/create-promotion', [promotionControllers::class, 'create_promotion'])->name('admin.create-promotion')->middleware('only.role');
    Route::post('/create-promotion', [promotionControllers::class, 'store'])->name('admin.create-store-promotion')->middleware('only.role');
    Route::get('/edit/promotion/{id}', [promotionControllers::class, 'edit'])->name('admin.edit-store-promotion')->middleware('only.role');
    Route::post('/edit/promotion', [promotionControllers::class, 'storeEdit'])->name('admin.edit-route-promotion')->middleware('only.role');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'only.role']], function () {
    Route::resources([
        'user' => 'UserController',
    ]);
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('clear-all', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('view', [CartController::class, 'view'])->name('cart.view');
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('register', [CustomerHomeController::class, 'register'])->name('customer.register');
    Route::get('login', [CustomerHomeController::class, 'login'])->name('customer.login');
    Route::get('logout', [CustomerHomeController::class, 'logout'])->name('customer.logout');
    //forget password
    Route::get('/forget-password', [CustomerHomeController::class, 'forgetPass'])->name('customer.forgetPass');
    Route::post('/forget-password', [CustomerHomeController::class, 'post_forgetPass']);
    Route::get('/get-password/{customer}/{token}', [CustomerHomeController::class, 'getPass'])->name('customer.getPass');
    Route::post('/get-password/{customer}/{token}', [CustomerHomeController::class, 'post_getPass']);
    //active account
    Route::get('/actived/{customer}/{token}', [CustomerHomeController::class, 'actived'])->name('customer.actived');
    //check login/register
    Route::post('register', [CustomerHomeController::class, 'post_register']);
    Route::post('login', [CustomerHomeController::class, 'post_login']);
    //profile customer
    Route::get('/edit/{id}', [CustomerHomeController::class, 'edit'])->name('customer.edit');
    Route::put('/update/{id}', [CustomerHomeController::class, 'update'])->name('customer.update');
    Route::get('profile', [CustomerHomeController::class, 'profile'])->name('customer.profile');
    Route::get('/changepassword', [CustomerHomeController::class, 'changepasswordform'])->name('customer.changepassword');
    Route::post('/changepassword', [CustomerHomeController::class, 'changepassword'])->name('customer.changepassword');
    //rating
    Route::post('/rating', [CustomerHomeController::class, 'rating'])->name('customer.rating');
});

Route::group(['prefix' => 'order', 'middleware' => 'customer'], function () {
    Route::get('checkout', [OrderHomeController::class, 'checkout'])->name('order.checkout');
    Route::get('success', [OrderHomeController::class, 'success'])->name('order.success');
    Route::get('order_success', [OrderHomeController::class, 'order_success'])->name('order.order_success');
    Route::post('checkout', [OrderHomeController::class, 'post_checkout']);
    Route::get('history', [OrderHomeController::class, 'history'])->name('home.order.history');
    Route::get('detail/{order}', [OrderHomeController::class, 'detail'])->name('home.order.detail');
    Route::get('/accept-order/{order}/{token}', [OrderHomeController::class, 'accept'])->name('order.accept');
});

//login logout admin
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'post_login']);
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::post('/admin/profile', [Usercontroller::class, 'update_avatar'])->name('admin.profile');

//home
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category');
Route::get('/{slug}', [HomeController::class, 'product_detail'])->name('product_detail');

Route::group(['prefix' => 'ajax'], function () {
    Route::post('/login', [AjaxLoginController::class, 'login'])->name('ajax.login');
    Route::post('/comment/{product_id}', [AjaxLoginController::class, 'comment'])->name('ajax.comment');
});
Route::get('/admin/403', function () {
    return view('admin/403');
})->name('admin.403');