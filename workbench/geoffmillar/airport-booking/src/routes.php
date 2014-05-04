<?php

Route::group(array('before' => 'auth'), function() {
	Route::group(array('namespace' => 'GeoffMillar\AirportBooking\Controllers'), function() {
		Route::get('admin/bookings/index', 		'AirportBookingAdminController@index');
		Route::get('admin/bookings/schedule', 	'AirportBookingAdminController@schedule');
		Route::get('admin/bookings/invoice', 	'AirportBookingAdminController@invoice');
		Route::get('admin/bookings/admin', 		'AirportBookingAdminController@admin');
		Route::get('admin/bookings/price', 		'AirportBookingAdminController@price');
		Route::get('admin/bookings/blocked', 	'AirportBookingAdminController@blocked');
		Route::get('admin/bookings/rate', 		'AirportBookingAdminController@rate');
	});
});
