<?php namespace GeoffMillar\ContentBlock\Validators;

use GeoffMillar\Admin\Services\Validators\Validator;

class BlockValidator extends Validator
{
	protected $rules = array(
		'key' => 'required',
		'label' => 'required',
		'content' => 'required',
		'active' => 'required'
		);
}
