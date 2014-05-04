<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Decorators\PageAdminDecorator;

class PageAdminController extends ModelAdminController
{
	public function __construct(PageAdminDecorator $page)
	{
		parent::__construct($page);
	}
}
