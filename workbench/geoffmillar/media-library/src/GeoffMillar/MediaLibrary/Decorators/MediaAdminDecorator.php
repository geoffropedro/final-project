<?php namespace GeoffMillar\MediaLibrary\Decorators;

use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\MediaLibrary\Models\Media;
use Illuminate\Config\Repository;
use Route;

class MediaAdminDecorator extends ModelAdminDecorator
{
	private $config;

	public function __construct(Media $media, Repository $config)
	{
		$this->config = $config;
		parent::__construct($media);
	}

	public function getColumns($instance)
	{
		$path = ($instance->display == 'website') ? 'uploads' : 'slider';

		return array(
			'ID' => $instance->id,
			'Image' => sprintf('<img src="%s" width="150">', asset('images/'.$path).'/'.$instance->filename),
			'Display' => $instance->display
			);
	}

	public function getLabel($instance)
	{

	}

	public function getFields()
	{

		(Route::getRoutes()->hasNamedRoute('admin.slider.index')) ? $displayOptions = ['website'=>'Website','slider'=>'Slider'] : $displayOptions = ['website'=>'Website'];

		return array(
			'type' => array(
				'type' => 'SelectField',
				'options' => $this->config->get('media-library::allowed_media_types', array('Image', 'PDF'))
				),

			'display' => array(
				'type' => 'SelectField',
				'options' => $displayOptions
				),

			'filename' => array(
				'type' => 'FileField'
				)
			);
	}
}
