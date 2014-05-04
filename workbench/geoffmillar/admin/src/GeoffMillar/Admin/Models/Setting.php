<?php namespace GeoffMillar\Admin\Models;

use GeoffMillar\Admin\Services\Validators\SettingValidator;
use STDClass;

class Setting extends Base
{
	protected $fillable = array('key', 'value','label');

	public function getValidator()
	{
		return new SettingValidator;
	}

	public function getByKey( $key ){
		return $this->where('key',$key)->first();
	}

	public function getByKeyValue( $key ){
		$result = $this->where('key',$key)->first();
		return $result->value;
	}

	public function setKeyAttribute($value)
	{
		$this->attributes['key'] = camel_case($value);
	}


	public function convert()
	{
		$settings = new STDClass();
        //Create settings object
		foreach ($this->all() as $id=>$value ){
			$record = $this->getByKey($value->key);
			$settings->$record['key']  = $record['value'];
		}
		return $settings;
	}
}