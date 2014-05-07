<?php namespace GeoffMillar\Theme\Models;

use Eloquent, STDClass;
use GeoffMillar\Theme\Validators\ThemeValidator;
use GeoffMillar\Admin\Models\Base;

class Theme extends Base
{
	protected $table = 'themes';
	protected $fillable = array('key', 'value', 'label');

	public function getValidator()
	{
		return new ThemeValidator;
	}

	//Get by key
	public function getByKey( $key ){
		return $this->where('key',$key)->first();
	}

	//Get by keyvalue
	public function getByKeyValue( $key ){
		$result = $this->where('key',$key)->first();

		

		return $result->value;
	}

	//Automatically add camelcase
	public function setKeyAttribute($value)
	{
		$this->attributes['key'] = camel_case($value);
	}

	//Convert into STDclass object
	public function convert()
	{
		$themes = new STDClass();
        //Create settings object
		foreach ($this->all() as $id=>$value ){
			$record = $this->getByKey($value->key);
			$themes->$record['key']  = $record['value'];
		}
		return $themes;
	}
}
