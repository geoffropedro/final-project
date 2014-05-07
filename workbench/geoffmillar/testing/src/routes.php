<?php

View::addNamespace('testing', app_path() . '/Testing/views');

Route::group(array('before' => 'auth'), function() {
	Route::resource('admin/testing', 'GeoffMillar\Testing\Controllers\TestingAdminController');
});
