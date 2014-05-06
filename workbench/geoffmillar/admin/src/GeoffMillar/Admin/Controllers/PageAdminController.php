<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Decorators\PageAdminDecorator;

class PageAdminController extends ModelAdminController
{
	//Dependancy injection
	public function __construct(PageAdminDecorator $page)
	{
		//Construct parent
		parent::__construct($page);
	}
}
