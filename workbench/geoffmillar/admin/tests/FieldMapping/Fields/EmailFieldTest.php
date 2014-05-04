<?php namespace GeoffMillar\Admin\Tests\FieldMapping\Fields;

use GeoffMillar\Admin\FieldMapping\Fields\EmailField;
use TestCase;

class EmailFieldTest extends TestCase
{
	public function testSuccess()
	{
		$field = new EmailField(array('name' => 'some_field', 'value' => 'foo@bar.com'));

		$this->assertContains('some_field', $field->getInput());
		$this->assertContains('foo@bar.com', $field->getInput());
		$this->assertContains('class="foo_class"', $field->getInput(array('class' => 'foo_class')));
	}

	public function testNoValue()
	{
		$field = new EmailField(array('name' => 'some_field'));

		$this->assertContains('some_field', $field->getInput());
		$this->assertContains('class="foo_class"', $field->getInput(array('class' => 'foo_class')));
	}
}
