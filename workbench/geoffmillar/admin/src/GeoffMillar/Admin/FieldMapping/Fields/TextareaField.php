<?php namespace GeoffMillar\Admin\FieldMapping\Fields;

use Illuminate\Support\Facades\Form;

class TextareaField extends Field
{
	public function getInput($params = array())
	{
		//$params['class'] = $params['class'] . " " . $this->params['class'];
		return Form::textarea($this->get('name'), null, $params);
	}
}
