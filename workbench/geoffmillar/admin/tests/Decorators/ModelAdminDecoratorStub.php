<?php namespace GeoffMillar\Admin\Tests\Decorators;

use GeoffMillar\Admin\Decorators\ModelAdminDecorator;

class ModelAdminDecoratorStub extends ModelAdminDecorator
{
	static $fields = array('one', 'two', 'three');

	public function getColumns($instance)
	{

	}

	public function getLabel($instance)
	{

	}
}