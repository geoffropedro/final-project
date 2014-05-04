<?php namespace GeoffMillar\Admin\Tests\Decorators;

use Mockery;

class ModelAdminDecoratorTest extends \TestCase
{
	private $decorator; 
	private $model;

	public function setup()
	{
		parent::setup();
		$this->model = Mockery::mock('Eloquent');
		$this->decorator = new ModelAdminDecoratorStub($this->model);
	}

	public function tearDown()
	{
		Mockery::close();
	}

	public function testGetModel()
	{
		$this->assertEquals($this->model, $this->decorator->getModel());
	}

	public function testGetListingModels()
	{
		$this->model->shouldReceive('all')->once()->andReturn('response');
		$this->assertEquals('response', $this->decorator->getListingModels());
	}

	public function testGetFields()
	{
		$this->assertEquals(array('one', 'two', 'three'), $this->decorator->getFields());
	}
}