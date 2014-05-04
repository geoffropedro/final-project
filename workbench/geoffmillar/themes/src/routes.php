<?php

Route::group(array('before' => 'auth'), function() {
	Route::resource('admin/themes', 'GeoffMillar\Theme\Controllers\ThemeAdminController');
});
