<?php namespace GeoffMillar\Testing\Validators;

use GeoffMillar\Admin\Services\Validators\Validator;

class TestingValidator extends Validator
{
	protected $rules = array(
		'id' => 'required'
		);
}
