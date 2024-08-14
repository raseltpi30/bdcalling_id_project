<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');
Route::get('admin-register', [App\Http\Controllers\Admin\RegisterController::class, 'adminRegister'])->name('admin.register');
Route::post('admin-register', [App\Http\Controllers\Admin\RegisterController::class, 'adminStore'])->name('admin.register');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'],function(){
    Route::get('/admin/home','AdminController@admin')->name('admin.home');
    Route::get('/admin/logout','AdminController@logout')->name('admin.logout');
    Route::get('/admin/password/change','AdminController@passwordChange')->name('admin.password.change');
    Route::post('/admin/password/update','AdminController@passwordUpdate')->name('admin.password.update');

      // Routes For Category 
    Route::group(['prefix' => 'category'],function(){
        Route::get('/','CategoryController@index')->name('category.index');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
        Route::post('/update/{id}','CategoryController@update')->name('category.update');
        Route::get('/delete/{category_id}','CategoryController@destroy')->name('category.delete');
    });
    Route::group(['prefix' => 'country'],function(){
        Route::get('/','CountryController@index')->name('country.index');
        Route::post('/store','CountryController@store')->name('country.store');
        Route::get('/edit/{id}','CountryController@edit')->name('country.edit');
        Route::post('/update','CountryController@update')->name('country.update');
        Route::get('/delete/{id}','CountryController@destroy')->name('country.delete');
    });
    Route::group(['prefix' => 'city'],function(){
        Route::get('/','CityController@index')->name('city.index');
        Route::post('/store','CityController@store')->name('city.store');
        Route::get('/edit/{id}','CityController@edit')->name('city.edit');
        Route::post('/update','CityController@update')->name('city.update');
        Route::get('/delete/{id}','CityController@destroy')->name('city.delete');
    });
    Route::group(['prefix' => 'property_size'],function(){
        Route::get('/','PropertySizeController@index')->name('PropertySize.index');
        Route::post('/store','PropertySizeController@store')->name('PropertySize.store');
        Route::get('/edit/{id}','PropertySizeController@edit')->name('PropertySize.edit');
        Route::post('/update','PropertySizeController@update')->name('PropertySize.update');
        Route::get('/delete/{id}','PropertySizeController@destroy')->name('PropertySize.delete');
    });
    Route::group(['prefix' => 'property_type'],function(){
        Route::get('/','PropertyTypeController@index')->name('PropertyType.index');
        Route::post('/store','PropertyTypeController@store')->name('PropertyType.store');
        Route::get('/edit/{id}','PropertyTypeController@edit')->name('PropertyType.edit');
        Route::post('/update','PropertyTypeController@update')->name('PropertyType.update');
        Route::get('/delete/{id}','PropertyTypeController@destroy')->name('PropertyType.delete');
    });

    Route::group(['prefix' => 'property'],function(){
        Route::get('/','PropertyController@index')->name('property.index');
        Route::get('/create','PropertyController@create')->name('property.create');
        Route::post('/store','PropertyController@store')->name('property.store');
        Route::get('/edit/{id}','PropertyController@edit')->name('property.edit');
        Route::post('/update','PropertyController@update')->name('property.update');
        Route::get('/delete/{id}','PropertyController@destroy')->name('property.delete');
    });
    Route::group(['prefix' => 'users'],function(){
        Route::get('/','AllManage@customerManage')->name('admin.userManage');
        Route::post('/update','AllManage@customerStatus')->name('admin.Update');
    });
    Route::group(['prefix' => 'bids'],function(){
        Route::get('/','AllManage@bidManage')->name('admin.bidManage');
    });
});

Auth::Routes();