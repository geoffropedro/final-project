<?php namespace GeoffMillar\Admin\Decorators;

use GeoffMillar\Admin\Models\Setting;
use Auth;

class SettingAdminDecorator extends ModelAdminDecorator
{
	public function __construct(Setting $setting)
	{
		parent::__construct($setting);
	}

	//Get the columns
	public function getColumns($instance)
	{
		return array(
			'Label' => $instance->label,
			'value' => $instance->value,
			'key' => $instance->key
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
		$fields = [
			'key' => array('type' => 'TextField'),
			'label' => array('type' => 'TextField'),
			'value' => array('type' => 'TextField')
			];

		//Only allow developers to change the key
		(Auth::user()->auth !="Developer") ? $fields['key']['params'] = ['readonly'=>'readonly'] : null;

		return $fields;
	}
}
