<?php namespace GeoffMillar\Slider\Models;

use Eloquent;
use GeoffMillar\Slider\Validators\SlideValidator;
use GeoffMillar\Admin\Models\Base;

class Slider extends Base
{
	protected $table = 'slider';
	protected $fillable = array('title', 'image', 'content', 'active');

	public function getValidator()
	{
		return new SlideValidator;
	}


}
