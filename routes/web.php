<?php

use App\Http\Controllers\ProductAttributeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\sizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Stripe Routes
Route::any('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');

    Route::post('/stripe_post', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
    Route::post('/stripe_process', [StripePaymentController::class, 'stripeProcess'])->name('stripe.process');
    Route::get('/stripe-success', [StripePaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::post('/send-email', [OrderController::class, 'sendEmail'])->name('send.email');

Route::get('admin/update_order_status_and_send_email/{status}/{id}', [OrderController::class, 'update_order_status']);


Route::get('/', [FrontController::class, 'index']);


Route::get('/categories/{slug}', [FrontController::class, 'showProductsByCategory'])->name('category.products');

Route::get('product/{slug}', [FrontController::class, 'productDetails']);
Route::get('order_placed', [FrontController::class, 'order_placed'])->name('order.placed');
//Route::get('category/{id}',[FrontController::class,'category']);
Route::post('add_to_cart', [FrontController::class, 'add_to_cart']);
Route::post('place_order', [FrontController::class, 'place_order']);
Route::post('coupon_code', [FrontController::class, 'coupon_code']);
Route::post('remove_coupon_code', [FrontController::class, 'remove_coupon_code']);
//Route::post('/add-to-cart',[FrontController::class,'addToCart'])->name('addToCart');

Route::get('cart', [FrontController::class, 'cart']);
Route::get('search/{str}', [FrontController::class, 'search']);
Route::get('checkout', [FrontController::class, 'checkout']);
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register_process', [CustomerController::class, 'store'])->name('register_process');
Route::post('forgot_process', [CustomerController::class, 'forgot_process']);
Route::post('forgot_password_change_process', [CustomerController::class, 'forgot_password_change_process']);

Route::get('user_login', [LoginController::class, 'login'])->name('user_login');
Route::post('login_process', [LoginController::class, 'login_process'])->name('login.login_process');
Route::get('logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
});
Route::get('/verification/{id}', [CustomerController::class, 'email_verification']);
Route::get('/forgot_password_change/{id}', [CustomerController::class, 'forgot_password_change']);


Route::get('admin', [AdminController::class, 'index']);
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/manage_category', [CategoryController::class, 'manage_category']);
    Route::get('admin/category/manage_category/{id}', [CategoryController::class, 'manage_category']);
    Route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);
    // Coupon Routes
    Route::get('admin/coupon_list', [CouponController::class, 'index'])->name('coupon_index');
    Route::get('/coupon/{id}/edit', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::put('/coupon/{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);
    Route::get('admin/coupon/status/{status}/{id}', [CouponController::class, 'status'])->name('admin.coupon.status');
    Route::post('admin/store_coupon', [CouponController::class, 'store'])->name('store_coupon');
    Route::get('add_coupon', [CouponController::class, 'show'])->name('show_add_coupon');
    // Size Routes
    Route::get('admin/size_list', [SizeController::class, 'index'])->name('size_index');
    Route::get('/size/{id}/edit', [SizeController::class, 'edit'])->name('size.edit');
    Route::put('/size/{id}', [SizeController::class, 'update'])->name('size.update');
    Route::get('admin/size/delete/{id}', [SizeController::class, 'delete']);
    Route::get('admin/size/status/{status}/{id}', [SizeController::class, 'status'])->name('admin.size.status');
    Route::post('admin/store_size', [SizeController::class, 'store'])->name('store_size');
    Route::get('add_size', [SizeController::class, 'show'])->name('show_add_size');
    // Color Routes
    Route::get('admin/color_list', [ColorController::class, 'index'])->name('color_index');
    Route::get('/color/{id}/edit', [ColorController::class, 'edit'])->name('color.edit');
    Route::put('/color/{id}', [ColorController::class, 'update'])->name('color.update');
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);
    Route::get('admin/color/status/{status}/{id}', [ColorController::class, 'status'])->name('admin.color.status');
    Route::post('admin/store_color', [ColorController::class, 'store'])->name('store_color');
    Route::get('add_color', [ColorController::class, 'show'])->name('show_add_color');

    // Product attribute routes
    Route::get('attribute/edit/{id}', [ProductAttributeController::class, 'edit'])->name('edit.attribute');
    Route::put('/attribute', [ProductAttributeController::class, 'update'])->name('attribute.update');

    // Product Routes
    Route::get('admin/product_list', [ProductController::class, 'index'])->name('product_index');
    Route::get('add_product', [ProductController::class, 'show'])->name('show_add_product');
    Route::post('admin/store_product', [ProductController::class, 'store'])->name('store_product');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status'])->name('admin.product.status');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);


//    Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
//    Route::post('admin/product/manage_producty_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
//    Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
//    Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
//    Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
//    Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);
    // Brand Routes
    Route::get('admin/brand_list', [BrandController::class, 'index'])->name('brand_index');
    Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);
    Route::get('admin/brand/status/{status}/{id}', [BrandController::class, 'status'])->name('admin.brand.status');
    Route::post('admin/store_brand', [BrandController::class, 'store'])->name('store_brand');
    Route::get('add_brand', [BrandController::class, 'show'])->name('show_add_brand');


    Route::get('admin/customer', [CustomerController::class, 'index']);
    Route::get('admin/customer/show/{id}', [CustomerController::class, 'show']);
    Route::get('admin/customer/status/{status}/{id}', [CustomerController::class, 'status']);

    // Banner Routes
    Route::get('admin/banner_list', [HomeBannerController::class, 'index'])->name('banner_index');;
    Route::get('/banner/{id}/edit', [HomeBannerController::class, 'edit'])->name('banner.edit');
    Route::put('/banner/{id}', [HomeBannerController::class, 'update'])->name('banner.update');
    Route::get('admin/delete/{id}', [HomeBannerController::class, 'delete']);
    Route::get('admin/banner/status/{status}/{id}', [HomeBannerController::class, 'status']);
    Route::post('admin/store_banner', [HomeBannerController::class, 'store'])->name('store_banner');
    Route::get('add_banner', [HomeBannerController::class, 'show'])->name('show_add_banner');


    // Add Attribute
    Route::get('admin/add_attribute/{id}', [ProductAttributeController::class, 'create'])->name('add.attribute');
    Route::post('products/{id}/attributes', [ProductAttributeController::class, 'store'])->name('product.attributes.store');
    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error', 'Logout sucessfully');
        return redirect('admin');
    });
});
Route::post('/get_max_quantity', [FrontController::class, 'getMaxQuantity']);
//Route::post('/get_max_quantity', 'FrontController@getMaxQuantity');


Route::get('admin/orders', [OrderController::class, 'index']);
Route::get('/admin/product_reviews', [ProductReviewController::class, 'index']);
Route::get('admin/update_product_review_status/{status}/{id}', [ProductReviewController::class, 'update_product_review_status']);
Route::get('admin/order_detail/{id}', [OrderController::class, 'order_detail']);
Route::get('admin/update_payment_status/{status}/{id}', [OrderController::class, 'update_payment_status']);
Route::get('admin/update_order_status/{status}/{id}', [OrderController::class, 'update_order_status']);
Route::post('admin/order_detail/{id}', [OrderController::class, 'update_track_detail']);
Route::post('/update_cart', [FrontController::class, 'updateCart']);


Route::group(['middleware' => 'user_auth'], function () {
    Route::get('/my_orders', [FrontController::class, 'myorders'])->name('my_orders');
    Route::get('/my_orders_detail/{id}', [FrontController::class, 'myorderdetail']);
    Route::post('product_review_process', [FrontController::class, 'product_review_process']);

});
Route::get('admin/attribute/delete/{id}', [ProductAttributeController::class, 'delete']);


