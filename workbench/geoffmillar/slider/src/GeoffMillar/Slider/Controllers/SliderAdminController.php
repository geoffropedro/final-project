<?php namespace GeoffMillar\Slider\Controllers;

use GeoffMillar\Admin\Controllers\ModelAdminController;
use GeoffMillar\Slider\Decorators\SliderAdminDecorator;

class SliderAdminController extends ModelAdminController
{
	public function __construct(SliderAdminDecorator $slider)
	{
		parent::__construct($slider);
	}
}
