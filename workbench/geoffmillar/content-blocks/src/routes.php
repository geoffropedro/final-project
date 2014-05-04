<?php

Route::group(array('before' => 'auth'), function() {
	Route::resource('admin/blocks', 'GeoffMillar\ContentBlock\Controllers\ContentBlockAdminController');
});
