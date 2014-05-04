<?php namespace GeoffMillar\Admin\Services\Validators;

class SettingValidator extends Validator
{
	protected $rules = array(
		'key' 	=> 'required|same:key',
		'value' => 'required',
		'label' => 'required'
		);
}
