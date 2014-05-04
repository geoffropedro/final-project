<?php namespace GeoffMillar\Admin\FieldMapping\Fields;

use Illuminate\Support\Facades\Form;

class PasswordField extends Field
{
	public function getInput($params = array())
	{
		 return Form::password($this->get('name'), $params);
	}
}
