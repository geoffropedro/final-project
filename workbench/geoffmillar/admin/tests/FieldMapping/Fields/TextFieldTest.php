<?php namespace GeoffMillar\Admin\Tests\FieldMapping\Fields;

use GeoffMillar\Admin\FieldMapping\Fields\TextField;
use TestCase;

class TextFieldTest extends TestCase
{
	public function testSuccess()
	{
		$label = 'Some label';
		$name = 'some_attribute';
		$field = new TextField(array('name' => $name, 'label' => $label));
		$this->assertContains($label, $field->getLabel());
		$this->assertContains($name, $field->getLabel());
	}
}
