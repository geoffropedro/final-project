<?php

Route::group(array('before' => 'auth'), function() {
	Route::resource('admin/slider', 'GeoffMillar\Slider\Controllers\SliderAdminController');
});
