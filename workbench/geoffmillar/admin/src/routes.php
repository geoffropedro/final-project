<?php

Route::group(array('namespace' => 'GeoffMillar\Admin\Controllers'), function() {

	Route::group(array('prefix' => 'admin'), function() {

		View::composer('admin::partials.nav', 'GeoffMillar\Admin\Composers\Nav');

		Route::group(array('before' => 'auth'), function() {
			Route::resource('pages', 	'PageAdminController');
			Route::resource('users', 	'UserAdminController');
			Route::resource('settings', 'SettingAdminController');

			Route::get('/', 'AdminController@getIndex');
			Route::get('logout', 'AdminController@getLogout');
		});

		Route::group(array('before' => 'guest'), function() {
			Route::get('login', 'AdminController@getLogin');
			Route::post('login', 'AdminController@postLogin');
		});

	});

	Route::get('{slug}', 'PageController@show')->where('slug', '.*');

});
