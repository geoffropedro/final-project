<?php namespace GeoffMillar\Admin\Controllers;

use View, Input, BaseController, Redirect, Auth;
use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\Admin\Facades\FieldMapper as FieldMapper;

abstract class ModelAdminController extends BaseController
{
	protected $decorator;
	protected $listingView 	= 'admin::overview';
	protected $editView 	= 'admin::edit';
	protected $createView 	= 'admin::create';
	protected $editable		= true;

	public function __construct(ModelAdminDecorator $decorator)
	{
		$this->decorator = $decorator;
	}

	protected function getColumnsForInstances(\ArrayAccess $instances)
	{
		$columns = array();
		foreach($instances as $instance) {
			$row = $this->decorator->getColumns($instance);
			$label = $this->decorator->getLabel($instance);
			$columns[] = $row;
		}
		return $columns;
	}

	public function index()
	{
		$instances = $this->decorator->getListingModels();

		return View::make($this->listingView, array(
			'instances' => $instances,
			'controller' => get_class($this),
			'modelName' => class_basename(get_class($this->decorator->getModel())),
			'columns' => $this->getColumnsForInstances($instances),
			'editable' => $this->editable
		));
	}

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

	public function store()
	{
		$modelInstance = $this->decorator->getModel()->newInstance();
		$validation = $modelInstance->getValidator();
		$input = Input::all();

		if ($validation->passesStore($input)) {
			$modelInstance->fill($input);
			$modelInstance->save();
			$response = Redirect::action(get_class($this) . '@index');
		} else {
			$response = Redirect::back()->withErrors($validation->getErrors())->withInput();
		}

		return $response;
	}

	public function edit($id)
	{
		$instance = $this->decorator->getModel()->find($id);

		return View::make($this->editView, array(
			'model' => $instance,
			'modelName' => class_basename(get_class($this->decorator->getModel())),
			'fields' => FieldMapper::getFields($this->decorator->getFields()),
			'action' => array(get_class($this) . '@update', $instance->id),
			'listingAction' => get_class($this) . '@index',
			'method' => 'PUT'
		));
	}

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

	public function destroy($id)
	{
		$instance = $this->decorator->getModel()->find($id);
		$instance->delete();

		return Redirect::action(get_class($this) . '@index');
	}

}
