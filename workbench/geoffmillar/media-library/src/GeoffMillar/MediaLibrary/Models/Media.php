<?php namespace GeoffMillar\MediaLibrary\Models;

use Eloquent;
use GeoffMillar\MediaLibrary\Validators\MediaValidator;
use GeoffMillar\Admin\Models\Base;
use Input;

class Media extends Base
{
	protected $table = 'media';
	protected $fillable = array('filename', 'type', 'display');

	public function getValidator()
	{
		return new MediaValidator;
	}

	public function setFilenameAttribute($value)
	{
		//Set image path
		$path = ($this->attributes['display'] == 'website') ? 'uploads' : 'slider';

		//Process image and store in public images directory
		if (Input::hasFile('filename')) {
			$file = Input::file('filename');
			$this->attributes['filename'] = $file->getClientOriginalName();
			$destinationPath = public_path() . '/images/'.$path.'/';
			$uploadSuccess = $file->move($destinationPath, $file->getClientOriginalName());
		}
	}
}
