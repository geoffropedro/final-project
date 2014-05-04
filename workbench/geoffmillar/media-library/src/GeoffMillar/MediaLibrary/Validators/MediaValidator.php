<?php namespace GeoffMillar\MediaLibrary\Validators;

use GeoffMillar\Admin\Services\Validators\Validator;

class MediaValidator extends Validator
{
	protected $rules = array(
		'type' => 'required',
		'display' => 'required'
	);
}
