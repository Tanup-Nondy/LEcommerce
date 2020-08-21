<?php

Route::group(['prefix'=>'/admin'],function(){
	Route::get('/','AdminController@index')->name('admin.index');
	//admin auth
	Route::get('/login','Auth\Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login/submit','Auth\Admin\LoginController@login')->name('admin.login.submit');
	Route::post('/logout/submit','Auth\Admin\LoginController@logout')->name('admin.logout');
	Route::get('/password/reset','Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/email','Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset/{token}','Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('/password/reset','Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');
		//product routes
	Route::group(['prefix'=>'/products'],function(){	
		Route::get('/create','AdminController@create')->name('admin.products.create');
		Route::get('/edit/{id}','AdminController@edit')->name('admin.products.edit');
		Route::get('/','AdminController@products')->name('admin.products');
		Route::post('/store','AdminController@store')->name('admin.products.store');
		Route::post('/update/{id}','AdminController@update')->name('admin.products.update');
		Route::post('/delete/{id}','AdminController@delete')->name('admin.products.delete');
	});
	//District route
	Route::group(['prefix'=>'/districts'],function(){	
		Route::get('/','DistrictController@index')->name('admin.districts');
		Route::get('/create','DistrictController@create')->name('admin.districts.create');
		Route::get('/edit/{id}','DistrictController@edit')->name('admin.districts.edit');
		Route::post('/store','DistrictController@store')->name('admin.districts.store');
		Route::post('/update/{id}','DistrictController@update')->name('admin.districts.update');
		Route::post('/delete/{id}','DistrictController@delete')->name('admin.districts.delete');
	});
	//Division Route
	Route::group(['prefix'=>'/divisions'],function(){	
		Route::get('/','DivisionController@index')->name('admin.divisions');
		Route::get('/create','DivisionController@create')->name('admin.divisions.create');
		Route::get('/edit/{id}','DivisionController@edit')->name('admin.divisions.edit');
		Route::post('/store','DivisionController@store')->name('admin.divisions.store');
		Route::post('/update/{id}','DivisionController@update')->name('admin.divisions.update');
		Route::post('/delete/{id}','DivisionController@delete')->name('admin.divisions.delete');
	});
	//orders Route
	Route::group(['prefix'=>'/orders'],function(){	
		Route::get('/','OrderController@index')->name('admin.orders');
		Route::get('/confirm/{id}','OrderController@confirm')->name('admin.orders.confirm');
		Route::get('/show/{id}','OrderController@show')->name('admin.orders.show');
		Route::post('/paid/{id}','OrderController@paid')->name('admin.orders.paid');
		Route::post('/delete/{id}','OrderController@delete')->name('admin.orders.delete');
		Route::post('/charge/{id}','OrderController@charge')->name('admin.orders.charge');
		Route::get('/invoice/{id}','OrderController@invoice')->name('admin.orders.invoice');
	});

	//slider Route
	Route::group(['prefix'=>'/sliders'],function(){	
		Route::get('/','SliderController@index')->name('admin.slider');
		Route::post('/store','SliderController@store')->name('admin.slider.store');
		Route::post('/update/{id}','SliderController@update')->name('admin.slider.update');
		Route::post('/delete/{id}','SliderController@delete')->name('admin.slider.delete');
	});
	//Division Route
	Route::group(['prefix'=>'/brands'],function(){	
		Route::get('/','BrandController@index')->name('admin.brand');
		Route::get('/create','BrandController@create')->name('admin.brand.create');
		Route::get('/edit/{id}','BrandController@edit')->name('admin.brand.edit');
		Route::post('/store','BrandController@store')->name('admin.brand.store');
		Route::post('/update/{id}','BrandController@update')->name('admin.brand.update');
		Route::post('/delete/{id}','BrandController@delete')->name('admin.brand.delete');
	});
	//Division Route
	Route::group(['prefix'=>'/categories'],function(){	
		Route::get('/','CategoryController@index')->name('admin.categories');
		Route::get('/create','CategoryController@create')->name('admin.categories.create');
		Route::get('/edit/{id}','CategoryController@edit')->name('admin.categories.edit');
		Route::post('/store','CategoryController@store')->name('admin.categories.store');
		Route::post('/update/{id}','CategoryController@update')->name('admin.categories.update');
		Route::post('/delete/{id}','CategoryController@delete')->name('admin.categories.delete');
	});
});

//main page
Route::get('/','PageController@index')->name('front.index');
Route::group(['prefix'=>'/home'],function(){	
		Route::get('/products','PageController@index')->name('products');
		Route::get('/show/{slug}','PageController@show')->name('products.show');
		Route::get('/search','PageController@search')->name('search');
		Route::get('/autocomplete','PageController@autocomplete')->name('autocomplete');
	});

///product
Route::group(['prefix'=>'/products'],function(){	
		Route::get('/categories/{id}','UserCategoryController@show')->name('product.category.show');
	});

//cart route
Route::group(['prefix'=>'/carts'],function(){	
		Route::get('/','CartModelController@index')->name('carts');
		Route::post('/store','CartModelController@store')->name('carts.store');
		Route::post('/update/{id}','CartModelController@update')->name('carts.update');
		Route::post('/delete/{id}','CartModelController@delete')->name('carts.delete');
	});
//checkout route
Route::group(['prefix'=>'/checkout'],function(){	
		Route::get('/','CheckoutController@index')->name('checkouts');
		Route::post('/store','CheckoutController@store')->name('checkouts.store');
	});

//user routes
Route::group(['prefix'=>'/users'],function(){	
		Route::get('/dashboard','UserController@dashboard')->name('user.dashboard');
		Route::get('/edit','UserController@edit')->name('user.edit');
		Route::get('/edit_password','UserController@edit_password')->name('user.edit_password');
		Route::post('/update','UserController@update')->name('user.update');
		Route::post('/update_password','UserController@update_password')->name('user.update_password');
	});

//user verification
Route::get('/verify/{token}','UserVerificationController@verify')->name('user.verfication');
Auth::routes();

Route::get('/home', 'HomeController@index');