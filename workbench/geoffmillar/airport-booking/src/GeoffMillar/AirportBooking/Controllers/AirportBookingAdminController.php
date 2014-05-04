<?php namespace GeoffMillar\AirportBooking\Controllers;

use Auth, BaseController, View;


class AirportBookingAdminController extends BaseController
{
	public function schedule()
	{
		return View::make('airport-booking::schedule');
	}

	public function invoice()
	{
		return View::make('airport-booking::invoice');
	}

	public function admin()
	{
		return View::make('airport-booking::admin');
	}

	public function price()
	{
		return View::make('airport-booking::price');
	}

	public function blocked()
	{
		return View::make('airport-booking::blocked');
	}

	public function rate()
	{
		return View::make('airport-booking::rate');
	}
}
