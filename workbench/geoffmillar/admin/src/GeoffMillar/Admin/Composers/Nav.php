<?php namespace GeoffMillar\Admin\Composers;

use Event;
use Auth;
use GeoffMillar\Admin\Components\Menu;

class Nav
{
	//Send mena data to the view
	function compose($view)
	{
		//Create menu objects
		$contentMenu = new Menu;
		$menu = new Menu;

		//Fire events
		Event::fire('admin.renderContentMenu', array($contentMenu));
		Event::fire('admin.renderMenu', array($menu));

		//Send data to view
		$view->with('menu', $menu)->with('user', Auth::user())->with('contentmenu', $contentMenu);
	}
}
