<?php namespace GeoffMillar\Admin\Decorators;

use Eloquent;

//Abstract to add functionality
abstract class ModelAdminDecorator
{
	protected $model;

	//Use elequent 
	public function __construct(Eloquent $model)
	{
		$this->model = $model;
	}

	abstract public function getColumns($instance);

	abstract public function getLabel($instance);

	abstract public function getFields();

	public function getModel()
	{
		return $this->model;
	}

	public function getListingModels()
	{
		return $this->model->all();
	}
}
