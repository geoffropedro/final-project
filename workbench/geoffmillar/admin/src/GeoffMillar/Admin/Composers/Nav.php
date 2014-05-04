<?php namespace GeoffMillar\Admin\Composers;

use Event;
use Auth;
use GeoffMillar\Admin\Components\Menu;

class Nav
{
	function compose($view)
	{
		$contentMenu = new Menu;
		$menu = new Menu;

		Event::fire('admin.renderContentMenu', array($contentMenu));
		Event::fire('admin.renderMenu', array($menu));

		$view->with('menu', $menu)->with('user', Auth::user())->with('contentmenu', $contentMenu);
	}
}
