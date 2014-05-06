<?php namespace GeoffMillar\Admin\Controllers;

use View, Input, BaseController, Redirect, Auth, ArrayAccess;
use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\Admin\Facades\FieldMapper as FieldMapper;

abstract class ModelAdminController extends BaseController
{
	protected $decorator;

	protected $formView 	= 'admin::form';
	protected $listingView 	= 'admin::overview';
	protected $editView 	= 'admin::edit';
	protected $createView 	= 'admin::create';
	protected $editable		= true;

	//Get the model
	public function __construct(ModelAdminDecorator $decorator)
	{
		$this->decorator = $decorator;
	}

	//Treat instance as array. Returns all table columns
	protected function getColumnsForInstances(ArrayAccess $instances)
	{
		$columns = array();
		foreach($instances as $instance) {
			$row = $this->decorator->getColumns($instance);
			$label = $this->decorator->getLabel($instance);
			$columns[] = $row;
		}
		return $columns;
	}

	//return the get request view with all vars
	public function index()
	{
		//Return model all()
		$instances = $this->decorator->getListingModels();

		return View::make($this->listingView, array(
			'instances' => $instances,
			'controller' => get_class($this), 
			'modelName' => class_basename(get_class($this->decorator->getModel())),
			'columns' => $this->getColumnsForInstances($instances),
			'editable' => $this->editable
		));
	}

	//Display view to create a new item. GET
	public function create()
	{
		return View::make($this->createView, array(
			'model' => $this->decorator->getModel(),
			'modelName' => class_basename(get_class($this->decorator->getModel())),
			'fields' => FieldMapper::getFields($this->decorator->getFields()),
			'method' => 'POST',
			'action' => get_class($this) . '@store',
			'listingAction' => get_class($this) . '@index'
		));
	}

	//Process new item creation. POST
	public function store()
	{
		//get this model instance
		$modelInstance = $this->decorator->getModel()->newInstance();
		//Get this model validation
		$validation = $modelInstance->getValidator();
		//Get a post
		$input = Input::all();

		//If validation passes
		if ($validation->passesStore($input)) {
			//Fill this model
			$modelInstance->fill($input);
			//Save this model
			$modelInstance->save();
			//Redirect to this model @index
			$response = Redirect::action(get_class($this) . '@index');
		} else {
			//Redirect back to previous page with validation errors and input
			$response = Redirect::back()->withErrors($validation->getErrors())->withInput();
		}

		return $response;
	}

	//Show existing item by id. GET
	public function edit($id)
	{
		//Find row
		$instance = $this->decorator->getModel()->find($id);

		//Make view with instance
		return View::make($this->editView, array(
			'model' => $instance,
			'modelName' => class_basename(get_class($this->decorator->getModel())),
			'fields' => FieldMapper::getFields($this->decorator->getFields()),
			'action' => array(get_class($this) . '@update', $instance->id),
			'listingAction' => get_class($this) . '@index',
			'method' => 'PUT'
		));
	}

	//Process update. POST
	public function update($id)
	{
		$modelInstance = $this->decorator->getModel()->find($id);
		$validation = $this->decorator->getModel()->getValidator();
		$validation->updateUniques($modelInstance->getId());
		$input = Input::all();

		if ($validation->passesEdit($input)) {
			$modelInstance->fill($input);
			$modelInstance->save();
			$response = Redirect::action(get_class($this) . '@index');
		} else {
			$response = Redirect::back()->withErrors($validation->getErrors())->withInput();
		}
		return $response;
	}

	//Remove item
	public function destroy($id)
	{
		$instance = $this->decorator->getModel()->find($id);
		$instance->delete();
		return Redirect::action(get_class($this) . '@index');
	}

}
