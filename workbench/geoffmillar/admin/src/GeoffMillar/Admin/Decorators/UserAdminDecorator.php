<?php namespace GeoffMillar\Admin\Decorators;

use GeoffMillar\Admin\Models\User;

class UserAdminDecorator extends ModelAdminDecorator
{
	public function __construct(User $user)
	{
		parent::__construct($user);
	}

	//Get the columns
	public function getColumns($instance)
	{
		return array(
			'ID' => $instance->id,
			'Username' => $instance->username,
			'Name' => $instance->name,
			'User type' => $instance->auth,
			);
	}
	
	//Get the form label
	public function getLabel($instance)
	{
		return $instance->getAttribute('name');
	}

	//Get the form fields
	public function getFields()
	{
		return array(
			'username' 		=> array('type' => 'TextField'),
			'name' 			=> array('type' => 'TextField'),
			'email' 		=> array('type' => 'EmailField'),
			'password' 		=> array('type' => 'PasswordField'),

			'auth' 			=> array(
				'type' 		=> 'SelectField',
				'options'	=> ['Developer'=>'Developer', 'Master'=>'Master', 'User'=>'User']
				)
			);
	}
}
