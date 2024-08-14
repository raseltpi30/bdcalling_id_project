<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

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
    //global route
	Route::get('/get-child-category/{id}','CategoryController@GetChildCategory');
    // Routes For SubCategory
    Route::group(['prefix' => 'subcategory'],function(){
        Route::get('/','SubCategoryController@index')->name('subcategory.index');
        Route::get('/add_subcategory','SubCategoryController@addItem')->name('subcategory.addItem');
        Route::post('/store','SubCategoryController@store')->name('subcategory.store');
        Route::get('/edit/{id}','SubCategoryController@edit')->name('subcategory.edit');
        Route::post('/update','SubCategoryController@update')->name('subcategory.update');
        Route::get('/delete/{subcategory_id}','SubCategoryController@destroy')->name('subcategory.delete');
    });
    // Routes For Category
    Route::group(['prefix' => 'childcategory'],function(){
        Route::get('/','ChildCategoryController@index')->name('childcategory.index');
        Route::post('/store','ChildCategoryController@store')->name('childcategory.store');
        Route::get('/edit/{childcategory_id}','ChildCategoryController@edit')->name('childcategory.edit');
        Route::post('/update','ChildCategoryController@update')->name('childcategory.update');
        Route::get('/delete/{childcategory_id}','ChildCategoryController@destroy')->name('childcategory.delete');
    });

    // Routes For Brands
    Route::group(['prefix' => 'brands'],function(){
        Route::get('/','BrandController@index')->name('brand.index');
        Route::post('/store','BrandController@store')->name('brand.store');
        Route::get('/edit/{id}','BrandController@edit')->name('brand.edit');
        Route::post('/update','BrandController@update')->name('brand.update');
        Route::get('/delete/{brand_id}','BrandController@destroy')->name('brand.delete');
    });
    //product routes
	Route::group(['prefix'=>'product'], function(){
		Route::get('/','ProductController@index')->name('product.index');
		Route::get('/create','ProductController@create')->name('product.create');
		Route::post('/store','ProductController@store')->name('product.store');
		Route::get('/delete/{id}','ProductController@destroy')->name('product.delete');
		Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
		Route::get('/show/{id}','ProductController@show')->name('product.show');
		Route::post('/update','ProductController@update')->name('product.update');
		Route::get('/active-featured/{id}','ProductController@activefeatured');
		Route::get('/not-featured/{id}','ProductController@notfeatured');
		Route::get('/active-deal/{id}','ProductController@activedeal');
		Route::get('/not-deal/{id}','ProductController@notdeal');
		Route::get('/active-status/{id}','ProductController@activestatus');
		Route::get('/not-status/{id}','ProductController@notstatus');
	});

    // Routes For Warehouse
    Route::group(['prefix' => 'warehouse'],function(){
        Route::get('/','WarehouseController@index')->name('warehouse.index');
        Route::post('/store','WarehouseController@store')->name('warehouse.store');
        Route::get('/edit/{id}','WarehouseController@edit')->name('warehouse.edit');
        Route::post('/update/{warehouse_id}','WarehouseController@update')->name('warehouse.update');
        Route::get('/delete/{warehouse_id}','WarehouseController@destroy')->name('warehouse.delete');
    });
    // Routes For Coupons
    Route::group(['prefix' => 'coupon'],function(){
        Route::get('/','CouponController@index')->name('coupon.index');
        Route::post('/store','CouponController@store')->name('coupon.store');
        Route::get('/edit/{coupon_id}','CouponController@edit')->name('coupon.edit');
        Route::post('/update/{coupon_id}','CouponController@update')->name('coupon.update');
        Route::get('/delete/{coupon_id}','CouponController@destroy')->name('coupon.delete');
    });
    //Campaign Routes
	Route::group(['prefix'=>'campaign'], function(){
		Route::get('/','CampaignController@index')->name('campaign.index');
		Route::post('/store','CampaignController@store')->name('campaign.store');
		Route::get('/delete/{id}','CampaignController@destroy')->name('campaign.delete');
		Route::get('/edit/{id}','CampaignController@edit');
		Route::post('/update','CampaignController@update')->name('campaign.update');
	});

	//__campaign product routes__//
	Route::group(['prefix'=>'campaign-product'], function(){
		Route::get('/{campaign_id}','CampaignController@campaignProduct')->name('campaign.product');
		Route::get('/add/{id}/{campaign_id}','CampaignController@ProductAddToCampaign')->name('add.product.to.campaign');
		Route::get('/list/{campaign_id}','CampaignController@ProductListCampaign')->name('campaign.product.list');
		Route::get('/remove/{id}','CampaignController@RemoveProduct')->name('product.remove.campaign');
		// Route::post('/update','CampaignController@update')->name('campaign.update');
	});

    // Routes For Setting
    Route::group(['prefix' => 'setting'],function(){
        // Route for seo
        Route::group(['prefix' => 'seo'],function(){
            Route::get('/','SettingController@seo')->name('setting.seo');
            Route::post('/update/{id}','SettingController@seoUpdate')->name('setting.seo.update');
        });
        // Route for Smtp
        Route::group(['prefix' => 'smtp'],function(){
            Route::get('/','SettingController@smtp')->name('setting.smtp');
            Route::post('/update','SettingController@smtpUpdate')->name('setting.smtp.update');
        });
        // Route for PaymentGateway
        Route::group(['prefix' => 'payment-gateway'],function(){
            Route::get('/','SettingController@PaymentGateway')->name('payment.index');
            Route::post('/update-aamarpay','SettingController@AamarpayUpdate')->name('update.aamarpay');
            Route::post('/update-surjopay','SettingController@SurjopayUpdate')->name('update.surjopay');
            Route::post('/update-surjopay','SettingController@SurjopayUpdate')->name('update.surjopay');
        });
        // Route for Smtp
        Route::group(['prefix' => 'page'],function(){
            Route::get('/','PageController@index')->name('page.index');
            Route::get('/add_page','PageController@create')->name('page.create');
            Route::post('/store','PageController@store')->name('page.store');
            Route::get('/edit/{page_id}','PageController@edit')->name('page.edit');
            Route::post('/update/{page_id}','PageController@update')->name('page.update');
            Route::get('/delete/{page_id}','PageController@destroy')->name('page.delete');
        });
        // Route for website settings
        Route::group(['prefix' => 'website_setting'],function(){
            Route::get('/','SettingController@website')->name('setting.website');
            Route::post('/update/{setting_id}','SettingController@websiteUpdate')->name('setting.website.update');
        });
    });
    //Pickup Point
		Route::group(['prefix'=>'pickup-point'], function(){
			Route::get('/','PickupController@index')->name('pickuppoint.index');
			Route::post('/store','PickupController@store')->name('store.pickup.point');
			Route::delete('/delete/{id}','PickupController@destroy')->name('pickup.point.delete');
			Route::get('/edit/{id}','PickupController@edit');
			Route::post('/update','PickupController@update')->name('update.pickup.point');
	    });
        //Ticket
		Route::group(['prefix'=>'ticket'], function(){
			Route::get('/','TicketController@index')->name('ticket.index');
			Route::get('/ticket/show/{id}','TicketController@show')->name('admin.ticket.show');
			Route::post('/ticket/reply','TicketController@ReplyTicket')->name('admin.store.reply');
			Route::get('/ticket/close/{id}','TicketController@CloseTicket')->name('admin.close.ticket');
			Route::delete('/ticket/delete/{id}','TicketController@destroy')->name('admin.ticket.delete');

	    });
    //Route for customer order
    Route::group(['prefix'=>'admin'], function(){
        Route::group(['prefix'=>'order'], function(){
            Route::get('/','OrderController@index')->name('admin.order.index');
            Route::get('/edit/{id}','OrderController@edit');
            Route::post('/update','OrderController@updateStatus')->name('update.order.status');
            Route::get('/view/{id}','OrderController@ViewOrder');
            Route::get('delete/{id}','OrderController@delete')->name('admin.order.delete');
        });
        Route::group(['prefix' => 'blog_category'],function(){
            Route::get('/','BlogController@index')->name('admin.blog.category');
            Route::post('/store','BlogController@store')->name('blog.category.store');
            Route::get('/delete/{id}','BlogController@destroy')->name('blog.category.delete');
            Route::get('/edit/{id}','BlogController@edit')->name('blog.category.edit');
            Route::post('/update','BlogController@update')->name('blog.category.update');
        });

    });
    Route::group(['prefix' => 'blog_category'],function(){
        Route::get('/blogs','BlogController@blog')->name('blog.index');
        Route::post('/store','BlogController@blogStore')->name('blog.store');
        Route::get('/edit/{id}','BlogController@blogEdit')->name('blog.edit');
        Route::post('/update','BlogController@blogUpdate')->name('blog.update');
        Route::get('/delete/{id}','BlogController@destroyBlog')->name('blog.delete');
    });
});
