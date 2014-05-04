<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Decorators\UserAdminDecorator;

class UserAdminController extends ModelAdminController
{
	protected $formView = 'admin::users.form';

	public function __construct(UserAdminDecorator $user)
	{
		parent::__construct($user);
	}
}
