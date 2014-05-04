<?php namespace GeoffMillar\Admin\FieldMapping;

class Mapper
{
	public function getFields(Array $fields)
	{
		$fieldInstances = array();
		foreach($fields as $attr => $params) {
			$params['name'] = $attr;
			$className = $params['type'];
			unset($params['type']);
			$fieldInstances[] = $this->makeField($className, $params);
		}

		return $fieldInstances;
	}

	public function makeField($name, $params)
	{
		$var = __NAMESPACE__ . '\\Fields\\' . $name;
		return new $var(\App::make('form'), $params);
	}
}
