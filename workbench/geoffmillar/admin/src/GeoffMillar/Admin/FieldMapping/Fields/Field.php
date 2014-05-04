<?php namespace GeoffMillar\Admin\FieldMapping\Fields;

use Illuminate\Html\FormBuilder as Form;
use Illuminate\Support\Fluent;
use Illuminate\Support\MessageBag;

abstract class Field extends Fluent
{
	abstract public function getInput($params);

	public function __construct(Form $form, $attr = array())
	{
		$this->form = $form;
		parent::__construct($attr);
	}

	public function getLabel($params = array())
	{
		return $this->form->label($this->get('name'), $this->get('label'), $params);
	}

	public function getErrors(MessageBag $errors)
	{
		if ($errors->first($this->get('name'))) {
			return '<p><strong>' . $errors->first($this->get('name')) . '</strong></p>';
		}
	}
}
