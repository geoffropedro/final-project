<?php namespace GeoffMillar\Admin\Services\Validators;

class PageValidator extends Validator
{
	protected $rules = array(
		'title' 			=> 'required',
		'slug' 				=> 'required|unique:pages',
		'metatitle' 		=> 'required',
		'metadescription' 	=> 'required',
		'template' 			=> 'required',
	);
}
