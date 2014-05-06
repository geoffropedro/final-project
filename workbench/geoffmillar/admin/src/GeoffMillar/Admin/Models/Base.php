<?php namespace GeoffMillar\Admin\Models;

use Eloquent;

//Abstract class to add functionality
abstract class Base extends Eloquent
{

	abstract public function getValidator();

	public function getId()
	{
		$primaryKey = $this->getKeyName();
		return $this->$primaryKey;
	}
}
