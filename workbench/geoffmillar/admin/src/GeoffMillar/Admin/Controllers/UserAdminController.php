<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Decorators\UserAdminDecorator;

class UserAdminController extends ModelAdminController
{
	//Override - this is a  test
	//protected $editView = 'admin::users.create';
	
	//Dependency injection
	public function __construct(UserAdminDecorator $user)
	{
		//Construct parent
		parent::__construct($user);
	}
}
