<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::post('customer/login', [App\Http\Controllers\Front\CustomerController::class, 'CustomerLogin'])->name('customer.login');
Route::get('customer/register', [App\Http\Controllers\Front\CustomerController::class, 'Register'])->name('customer.register');
Route::post('customer/register', [App\Http\Controllers\Front\CustomerController::class, 'CustomerRegister']);

Route::group(['namespace' => 'App\Http\Controllers\Front'],function(){
    Route::get('customer/logout','ProfileController@CustomerLogout')->name('customer.logout');
    Route::get('/home','ProfileController@Home')->name('home');
    Route::get('/','IndexController@index')->name('index');
    Route::get('/product_details/{slug}','IndexController@productDetails')->name('product.details');
    Route::get('/product-quick-view/{id}','ReviewController@quick')->name('product.view');
    //Route For Cart
    Route::post('/add-to-cart','CartController@index')->name('add.to.cart');
    Route::get('/all-cart','CartController@AllCart')->name('all.cart'); //ajax request for subtotal
    Route::get('/mycart','CartController@MyCart')->name('cart');
    Route::get('/empty/cart','CartController@EmptyCart')->name('empty.cart');
    Route::get('/cartproduct/remove/{rowId}','CartController@RemoveCart')->name('cartproduct.remove');
    Route::get('/cartproduct/updateqty/{rowId}/{qty}','CartController@UpdateQty')->name('cartproduct.updateqty');
    Route::get('/cartproduct/colorUpdate/{rowId}/{color}','CartController@ColorUpdate')->name('cartproduct.colorUpdate');
    Route::get('/cartproduct/sizeUpdate/{rowId}/{size}','CartController@SizeUpdate')->name('cartproduct.sizeUpdate');

    //Route For Wishlist
    Route::get('/wishlist/{id}','ReviewController@addWishlist')->name('product.wishlist');
    Route::get('/wishlist','CartController@wishlist')->name('wishlist');
    Route::get('/wishlistproduct/remove/{id}','CartController@RemoveWishlist')->name('wishlistproduct.remove');
    Route::get('/empty/wishlist','CartController@EmptyWishlist')->name('empty.wishlist');

    //ROute for checkout
    Route::get('/checkout','CheckoutController@checkout')->name('checkout');
    Route::post('/apply/coupon','CheckoutController@ApplyCoupon')->name('apply.coupon');
    Route::get('/remove/coupon','CheckoutController@RemoveCoupon')->name('remove.coupon');
    Route::post('/order/place','CheckoutController@OrderPlace')->name('order.place');

    // categorywise product
    Route::get('/categorywise/{id}','IndexController@CategoryWiseProduct')->name('categorywise.product');
    Route::get('/subcategorywise/{id}','IndexController@SubCategoryWiseProduct')->name('subcategorywise.product');
    Route::get('/childcategorywise/{id}','IndexController@ChildCategoryWiseProduct')->name('childcategorywise.product');
    Route::get('/brandwise/{id}','IndexController@BrandWiseProduct')->name('brandwise.product');
    
    // Review for product    
    Route::post('/review','ReviewController@review')->name('product.review');

    // Review for website    
    Route::get('/webreview','ProfileController@WriteReview')->name('write.review');
    Route::post('/storereview','ProfileController@StoreReview')->name('store.review');

    // Route for Customer Password Change
    Route::get('/home/setting','ProfileController@setting')->name('customer.setting');
    Route::post('/customer/password','ProfileController@PasswordChange')->name('customer.password.change');

    //Route for pages
    Route::get('/page/{page_slug}','IndexController@ViewPage')->name('view.page');
    Route::post('/newsletter','IndexController@Newsletter')->name('newsletter');

    //Route for customer order list
    Route::get('/my/order','ProfileController@MyOrder')->name('my.order');
    Route::get('/view/order/{id}','ProfileController@ViewOrder')->name('view.order');

    //Route for customer ticket
    Route::get('/open/ticket','TicketController@OpenTicket')->name('open.ticket');
    Route::get('/new/ticket','TicketController@NewTicket')->name('new.ticket');
    Route::post('/store/ticket','TicketController@StoreTicket')->name('store.ticket');
    Route::get('/show/ticket/{id}','TicketController@ShowTicket')->name('show.ticket');

    //order tracking
    Route::get('/order/tracking','IndexController@OrderTracking')->name('order.tracking');
    Route::post('/check/order','IndexController@CheckOrder')->name('check.order');

});

Auth::Routes();
