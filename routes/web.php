<?php

use App\Http\Controllers\website\CustomeController;
use App\Http\Controllers\website\HomeController as WebController;
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

Route::get('/', [WebController::class, 'index'])->name('home');
Route::post('/search/properties', [WebController::class, 'searchProperties'])->name('search.properties');

Route::get('/property_details/{id}/{slug}', [WebController::class, 'propertyDetails'])->name('propertyDetails');

Route::post('/property_details/bid', [WebController::class, 'bidNew'])->name('bid.new');


// login and Registration
Route::get('/customer/registration', [CustomeController::class, 'registrationForm'])->name('customer.registration');
Route::post('/customer/registration', [CustomeController::class, 'saveCustomerInfo'])->name('customer.registration');

Route::get('/customer/login', [CustomeController::class, 'loginForm'])->name('customer.login');
Route::get('/customer/logout', [CustomeController::class, 'logout'])->name('customer.logout');
Route::post('/customer/login', [CustomeController::class, 'customerLoginCheck'])->name('customer.login');

Auth::Routes();
