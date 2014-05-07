<?php namespace GeoffMillar\Slider\Decorators;

use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\Slider\Models\Slider;
use File;

class SliderAdminDecorator extends ModelAdminDecorator
{
	public function __construct(Slider $slider)
	{
		parent::__construct($slider);
	}

	public function getColumns($instance)
	{
		return array(
			'ID' => $instance->id,
			'Title' => $instance->title,
			'Image' => sprintf('<img src="%s" width="150">', asset('images/slider')."/".$instance->image),
			);
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('name');
	}

	public function getFields()
	{
		return array(
			'title' 			=> array(
				'label' 		=> 'Title',
				'type' 			=> 'TextField',
				'params' 		=> ['onclick'=>'go()']
				),

			'image' 			=> array(
				'label' 		=> 'Image',
				'type' 			=> 'SelectField',
				'options'		=> $this->getSlideImages()
				),

			'content' 			=> array(
				'label' 		=> 'Content',
				'type' 			=> 'TextareaField',
				'title' 		=> 'wysiwyg'
				),

			'active' 			=> array(
				'label' 		=> 'Active',
				'type' 			=> 'SelectField',
				'options' 		=> ['1'=>'Yes','0'=>'No']
				)
			);
	}

	//Get slide from directory for select.
	public static function getSlideImages()
	{
		$files = File::files(public_path()."/images/slider/");

		foreach($files as $file) {
			$images[basename($file)] = basename($file);
		}
		return $images;
	}
}
