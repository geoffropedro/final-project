<?php namespace GeoffMillar\Admin\Tests\FieldMapping;

use GeoffMillar\Admin\Tests\TestCase;
use GeoffMillar\Admin\FieldMapping\Mapper;
use Mockery;

class MapperTest extends TestCase
{
	protected $mapper;

	public function setUp()
	{
		parent::setUp();
		$this->mapper = new Mapper;
	}

	public function testGetFields()
	{
		$data = array(
			'name' => array(
				'type' => 'TextField',
				'label' => 'Your Name'
			)
		);
		$fields = $this->mapper->getFields($data);
		foreach($fields as $field) {
			$this->assertInstanceOf('GeoffMillar\\Admin\\FieldMapping\\Fields\\TextField', $field);

			$fieldAttributes = $field->toArray();
			$this->assertArrayHasKey('name', $fieldAttributes);
			$this->assertArrayHasKey('label', $fieldAttributes);
			$this->assertEquals('Your Name', $field->get('label'));
			$this->assertEquals('name', $field->get('name'));
		}
	}

	public function testGetFieldsWithSelect()
	{
		$data = array(
			'gender' => array(
				'type' => 'SelectField',
				'label' => 'Your Gender',
				'options' => array('Male', 'Female')
			)
		);
		$fields = $this->mapper->getFields($data);
		foreach($fields as $field) {
			$this->assertInstanceOf('GeoffMillar\\Admin\\FieldMapping\\Fields\\SelectField', $field);

			$fieldAttributes = $field->toArray();
			$this->assertArrayHasKey('name', $fieldAttributes);
			$this->assertArrayHasKey('label', $fieldAttributes);
			$this->assertArrayHasKey('options', $fieldAttributes);
			$this->assertEquals('Your Gender', $field->get('label'));
			$this->assertEquals('gender', $field->get('name'));
			$this->assertEquals(array('Male', 'Female'), $field->get('options'));
		}	
	}
}
