<?php namespace GeoffMillar\Admin\Controllers;

use Redirect, Auth, View;

class AdminController extends \BaseController
{
	public function getIndex()
	{
		return View::make('admin::index');
	}

	public function getLogin()
	{
		View::addNamespace('admin', app_path() . '/Admin/views');
		return View::make('admin::login');
	}

	public function postLogin()
	{
		if(Auth::attempt(\Input::only('email','password')))
		{
			return Redirect::to('admin');
		} 
		return Redirect::back()->withInput()->with('error','<p><b>Email & Password combination not recognised</b></p><p>Please try again or <a href="/admin/password/remind">reset your password</a>');
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('admin')->with('message', 'Logged out');
	}
}
