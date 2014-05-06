<?php

//Namespace the group
Route::group(array('namespace' => 'GeoffMillar\Admin\Controllers'), function() {

	//Prefix the group
	Route::group(array('prefix' => 'admin'), function() {

		//Send navigation variables to the nav view
		View::composer('admin::partials.nav', 'GeoffMillar\Admin\Composers\Nav');

		//Add auth filter to all included routes
		Route::group(array('before' => 'auth'), function() {
			Route::resource('pages', 	'PageAdminController');
			Route::resource('users', 	'UserAdminController');
			Route::resource('settings', 'SettingAdminController');
			Route::get('/', 'AdminController@getIndex');
			Route::get('logout', 'AdminController@getLogout');
		});

		//Add before filter to included
		Route::group(array('before' => 'guest'), function() {
			Route::get('login', 'AdminController@getLogin');
			Route::post('login', 'AdminController@postLogin');
		});

	});

	//Get any page slug and pass to controller
	Route::get('{slug}', 'PageController@show')->where('slug', '.*');
});
