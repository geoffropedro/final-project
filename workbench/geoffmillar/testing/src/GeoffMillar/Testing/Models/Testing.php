<?php namespace GeoffMillar\Testing\Models;

use Eloquent;
use GeoffMillar\Testing\Validators\TestingValidator;
use GeoffMillar\Admin\Models\Base;

class Testing extends Base
{
	protected $table = 'testing';
	protected $fillable = array('id');
	public	  $timestamps=false;

	public function getValidator()
	{
		return new TestingValidator;
	}
}
