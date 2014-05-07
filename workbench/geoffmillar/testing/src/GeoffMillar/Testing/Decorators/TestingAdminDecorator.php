<?php namespace GeoffMillar\Testing\Decorators;

use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\Testing\Models\Testing;


class TestingAdminDecorator extends ModelAdminDecorator
{
	public function __construct(Testing $testing)
	{
		parent::__construct($testing);
	}

	public function getColumns($instance)
	{
		return array(
			'Test' => $instance->id,
			);
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('name');
	}

	public function getFields()
	{
		return array(
			'id' 			=> array(
				'label' 		=> 'Title',
				'type' 			=> 'TextField'
				)
			);
	}
}
