<?php namespace GeoffMillar\Slider\Validators;

use GeoffMillar\Admin\Services\Validators\Validator;

class SlideValidator extends Validator
{
	protected $rules = array(
		'title' => 'required',
		'image' => 'required',
		'active' => 'required'
		);
}
