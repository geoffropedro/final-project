<?php namespace GeoffMillar\Testing\Controllers;

use GeoffMillar\Admin\Controllers\ModelAdminController;
use GeoffMillar\Testing\Decorators\TestingAdminDecorator;

class TestingAdminController extends ModelAdminController
{

	protected $listingView 	= 'testing::overview';

	public function __construct(TestingAdminDecorator $testing)
	{
		parent::__construct($testing);
	}
}
