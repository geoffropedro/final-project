<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Decorators\SettingAdminDecorator;
use GeoffMillar\Admin\Facades\FieldMapper as FieldMapper;
use View, Auth;

class SettingAdminController extends ModelAdminController
{
	public function __construct(SettingAdminDecorator $setting)
	{
		parent::__construct($setting);
		(Auth::user()->auth != 'Developer') ? $this->editable = false : null;
	}
}
