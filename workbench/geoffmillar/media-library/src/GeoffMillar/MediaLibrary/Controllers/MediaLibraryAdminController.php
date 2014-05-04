<?php namespace GeoffMillar\MediaLibrary\Controllers;

use GeoffMillar\Admin\Controllers\ModelAdminController;
use GeoffMillar\MediaLibrary\Decorators\MediaAdminDecorator;
use Redirect;

class MediaLibraryAdminController extends ModelAdminController
{
	public function __construct(MediaAdminDecorator $media)
	{
		parent::__construct($media);
	}

	//Override GeoffMillar/Admin/Controllers/ModelAdminController
	public function destroy($id)
	{
		$instance = $this->decorator->getModel()->find($id);
		//Get directory
		$path = ($instance->display == "slider") ? 'slider/' : 'uploads/';
		$instance->delete();
		//Set unlink path
		$image = public_path().'/images/'.$path.$instance->filename;
		//Delete ii file exists
		if (file_exists($image))
		unlink($image);

		return Redirect::action(get_class($this) . '@index');
	}
}
