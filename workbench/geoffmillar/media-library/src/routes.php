<?php

Route::group(array('before' => 'auth'), function() {
	Route::resource('admin/media', 'GeoffMillar\MediaLibrary\Controllers\MediaLibraryAdminController');
});
