<?php namespace GeoffMillar\Admin\Controllers;

use Redirect, Auth, View, File;

class AdminController extends \BaseController
{
	//Return the admin homepage
	public function getIndex()
	{
		return View::make('admin::index');
	}

	//Return the login view
	public function getLogin()
	{
		View::addNamespace('admin', app_path() . '/Admin/views');
		return View::make('admin::login');
	}

	//Handle the login post request
	public function postLogin()
	{
		if(Auth::attempt(\Input::only('email','password')))
		{
			return Redirect::to('admin');
		} 
		return Redirect::back()->withInput()->with('error','<p><b>Email & Password combination not recognised</b></p><p>Please try again');
	}

	//Logout and redirect to admin -> admin will redirect to login
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('admin')->with('message', 'Logged out');
	}

}
