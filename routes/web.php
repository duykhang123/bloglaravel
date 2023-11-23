<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ProductReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SmtpSettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('user/auth', [IndexController::class, 'userAuth'])->name('user.auth');
Route::get('product-cate/{slug}', [IndexController::class, 'productCategory'])->name('product.category');
Route::get('product-detail/{slug}', [IndexController::class, 'productDetail'])->name('product.detail');
Route::post('user/submit', [IndexController::class, 'userLogin'])->name('login.submit');
Route::get('user/logout', [IndexController::class, 'userLogout'])->name('login.logout');
Route::post('user/register', [IndexController::class, 'userRegister'])->name('user.register');
Route::get('shop', [IndexController::class, 'shop'])->name('shop');
Route::post('shop-filter', [IndexController::class, 'shopFilter'])->name('shop.filter');
Route::get('autosearch', [IndexController::class, 'autoSearch'])->name('autosearch');
Route::get('search', [IndexController::class, 'search'])->name('search');
Route::get('about-us', [IndexController::class, 'aboutUs'])->name('about-us');


Route::get('blog', [BlogController::class, 'blog'])->name('blog');
Route::get('single_blog/{slug}', [BlogController::class, 'single_blog'])->name('single_blog');

Route::get('cart', [CartController::class, 'cartIndex'])->name('cart.index');
Route::post('cart/store', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::post('coupon/add', [CartController::class, 'couponAdd'])->name('coupon.add');



Route::get('wishlist', [WishlistController::class, 'wishlistIndex'])->name('wishlist.index');
Route::post('wishlist/store', [WishlistController::class, 'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-to-cart', [WishlistController::class, 'wishlistMoveCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete', [WishlistController::class, 'wishlistDelete'])->name('wishlist.delete.cart');

Route::post('/upload', [HomeController::class, 'upload'])->name('ckeditor.upload');

Route::get('checkout1', [CheckoutController::class, 'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-first', [CheckoutController::class, 'checkout1Store'])->name('checkout1.store');
Route::post('checkout-two', [CheckoutController::class, 'checkout2Store'])->name('checkout2.store');
Route::post('checkout-three', [CheckoutController::class, 'checkout3Store'])->name('checkout3.store');
Route::post('checkout', [CheckoutController::class, 'checkoutStore'])->name('checkout');
Route::get('complete/{order}', [CheckoutController::class, 'complete'])->name('complete');

Route::post('vnpay', [CheckoutController::class, 'create'])->name('vnpay');

Route::post('currency-load', [CurrencyController::class, 'currencyLoad'])->name('currency.load');

Route::post('product-review/{slug}', [ProductReviewController::class, 'productReview'])->name('product.review');


Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {

    /*====================================  DASHBOARD =======================================*/
    $prefix = 'dashboard';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [DashboardController::class, 'index'])->name('index');
        Route::get('form', [DashboardController::class, 'form'])->name('form');
        Route::get('delete', [DashboardController::class, 'delete']);
        Route::match(['get', 'post'], 'deleteOnly/{id}', [DashboardController::class, 'deleteOnly'])->name('deleteOnly');
    });

    /*====================================  ORDER =======================================*/
    $prefix = 'order';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [OrderController::class, 'index'])->name('index');
        Route::get('form', [OrderController::class, 'form'])->name('form');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [OrderController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('delete', [OrderController::class, 'delete']);
        Route::post('editCondition', [OrderController::class, 'editCondition'])->name('editCondition');
        Route::match(['get', 'post'], 'edit/{id}', [OrderController::class, 'edit'])->name('edit');
    });


    /*====================================  SMTP SETTING =======================================*/
    $prefix = 'smtp';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::match(['get', 'post'],'form', [SmtpSettingController::class, 'form'])->name('form');
    });


    /*====================================  ABOUT US =======================================*/
    $prefix = 'aboutus';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::match(['get', 'post'],'form', [AboutUsController::class, 'form'])->name('form');
    });


    /*====================================  USER =======================================*/
    $prefix = 'user';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('form', [UserController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [UserController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [UserController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [UserController::class, 'save'])->name('save');
        Route::post('delete', [UserController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [UserController::class, 'deleteOnly'])->name('deleteOnly');
        Route::match(['get', 'post'], 'edit/{id}', [UserController::class, 'edit'])->name('edit');
    });

    /*====================================  CATEGORY =======================================*/
    $prefix = 'category';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [CategoryController::class, 'index'])->name('index');
        Route::get('form', [CategoryController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [CategoryController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [CategoryController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [CategoryController::class, 'save'])->name('save');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [CategoryController::class, 'deleteOnly'])->name('deleteOnly');
        Route::post('delete', [CategoryController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    });

    /*====================================  CURRENCY =======================================*/
    $prefix = 'currency';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [CurrencyController::class, 'index'])->name('index');
        Route::get('form', [CurrencyController::class, 'form'])->name('form');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [CurrencyController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('changeStatus/{status}', [CurrencyController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [CurrencyController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [CurrencyController::class, 'save'])->name('save');
        Route::post('delete', [CurrencyController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [CurrencyController::class, 'edit'])->name('edit');
    });

    /*====================================  SHIPPING =======================================*/
    $prefix = 'shipping';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [ShippingController::class, 'index'])->name('index');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [ShippingController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('form', [ShippingController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [ShippingController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [ShippingController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [ShippingController::class, 'save'])->name('save');
        Route::post('delete', [ShippingController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [ShippingController::class, 'edit'])->name('edit');
    });

    /*====================================  COUPON =======================================*/
    $prefix = 'coupon';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [CouponController::class, 'index'])->name('index');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [CouponController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('form', [CouponController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [CouponController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [CouponController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [CouponController::class, 'save'])->name('save');
        Route::post('delete', [CouponController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [CouponController::class, 'edit'])->name('edit');
    });

    /*==================================== PRODUCT CATEGORY =======================================*/
    $prefix = 'productcategory';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [ProductCategoryController::class, 'index'])->name('index');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [ProductCategoryController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('form', [ProductCategoryController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [ProductCategoryController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [ProductCategoryController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [ProductCategoryController::class, 'save'])->name('save');
        Route::post('delete', [ProductCategoryController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [ProductCategoryController::class, 'edit'])->name('edit');
    });

    /*==================================== BRAND =======================================*/
    $prefix = 'brand';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [BrandController::class, 'index'])->name('index');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [BrandController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('form', [BrandController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [BrandController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [BrandController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [BrandController::class, 'save'])->name('save');
        Route::post('delete', [BrandController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [BrandController::class, 'edit'])->name('edit');
    });

    /*====================================  PRODUCT =======================================*/
    $prefix = 'product';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [ProductController::class, 'index'])->name('index');
        Route::get('form', [ProductController::class, 'form'])->name('form');
        Route::get('changeStatus/{status}', [ProductController::class, 'changeStatus'])->name('changeStatus');
        Route::get('changeSpecial/{special}', [ProductController::class, 'changeSpecial'])->name('changeSpecial');
        Route::post('changePublish/{status}', [ProductController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [ProductController::class, 'save'])->name('save');
        Route::post('delete', [ProductController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [ProductController::class, 'deleteOnly'])->name('deleteOnly');
        Route::post('attribute/{id}', [ProductController::class, 'attribute'])->name('attribute');
        Route::match(['get', 'post'], 'edit/{id}', [ProductController::class, 'edit'])->name('edit');
    });

    /*====================================  TAG =======================================*/
    $prefix = 'tag';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('addTag', [TagController::class, 'addTag'])->name('addTag');
        Route::get('removeTag', [TagController::class, 'removeTag'])->name('removeTag');
    });

    /*====================================  POST =======================================*/
    $prefix = 'post';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [PostController::class, 'index'])->name('index');
        Route::get('form', [PostController::class, 'form'])->name('form');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [PostController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('changeStatus/{status}', [PostController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [PostController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [PostController::class, 'save'])->name('save');
        Route::post('delete', [PostController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [PostController::class, 'edit'])->name('edit');
    });

    /*====================================  BANNER =======================================*/
    $prefix = 'banner';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [BannerController::class, 'index'])->name('index');
        Route::get('form', [BannerController::class, 'form'])->name('form');
        Route::match(['get', 'post'], 'deleteOnly/{id}', [BannerController::class, 'deleteOnly'])->name('deleteOnly');
        Route::get('changeStatus/{status}', [BannerController::class, 'changeStatus'])->name('changeStatus');
        Route::post('changePublish/{status}', [BannerController::class, 'changePublish'])->name('changePublish');
        Route::post('save', [BannerController::class, 'save'])->name('save');
        Route::post('delete', [BannerController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'edit/{id}', [BannerController::class, 'edit'])->name('edit');
    });
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [IndexController::class, 'userDashboard'])->name('dashboard');
    Route::get('/order', [IndexController::class, 'userOrder'])->name('order');
    Route::get('/addresses', [IndexController::class, 'userAddresses'])->name('addresses');
    Route::post('/editAddresses', [IndexController::class, 'editAddresses'])->name('editAddresses');
    Route::post('/editShippingAddresses', [IndexController::class, 'editShippingAddresses'])->name('editShippingAddresses');
    Route::match(['get', 'post'], '/details', [IndexController::class, 'userDetails'])->name('details');
});



Route::prefix('seller')->middleware(['auth', 'seller'])->name('seller.')->group(function () {

    /*====================================  DASHBOARD =======================================*/
    $prefix = 'dashboard';
    Route::prefix($prefix)->name($prefix . '.')->group(function () {
        Route::get('index', [DashboardController::class, 'index'])->name('index');
        Route::get('form', [DashboardController::class, 'form'])->name('form');
        Route::get('delete', [DashboardController::class, 'delete']);
    });
});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
