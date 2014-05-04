<?php namespace GeoffMillar\Theme\Validators;

use GeoffMillar\Admin\Services\Validators\Validator;

class ThemeValidator extends Validator
{
	protected $rules = array(
		'key' => 'required',
		'label' => 'required',
		'value' => 'required'
		);
}
