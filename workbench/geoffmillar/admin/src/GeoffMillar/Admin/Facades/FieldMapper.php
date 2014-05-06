<?php namespace GeoffMillar\Admin\Facades;

use Illuminate\Support\Facades\Facade;

//http://laravel.com/docs/facades
//I need to research facades
class FieldMapper extends Facade {
	protected static function getFacadeAccessor() { return 'field.mapper'; }
}