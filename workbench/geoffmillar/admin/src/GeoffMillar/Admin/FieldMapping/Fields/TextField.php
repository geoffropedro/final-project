<?php namespace GeoffMillar\Admin\FieldMapping\Fields;

class TextField extends Field
{
	public function getInput($params = array())
	{
		if (isset($this->params['class']))
			$params['class'] = $params['class'] . " " . $this->params['class'];

		if($this->params && !isset($this->params['class']))
			$params = array_merge($params, $this->params);

		return $this->form->text($this->get('name'), null, $params);
	}
}
