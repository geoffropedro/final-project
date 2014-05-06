<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Decorators\SettingAdminDecorator;
use GeoffMillar\Admin\Facades\FieldMapper as FieldMapper;
use View, Auth;

class SettingAdminController extends ModelAdminController
{
	//Dependancy injection
	public function __construct(SettingAdminDecorator $setting)
	{
		//Construct parent
		parent::__construct($setting);

		//Is the model editable - quick solution for time constraint
		(Auth::user()->auth != 'Developer') ? $this->editable = false : null;
	}
}
