<?php namespace GeoffMillar\Theme\Decorators;

use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\Theme\Models\Theme;
use Illuminate\Config\Repository;
use Request, File, Route, Auth;

class ThemeAdminDecorator extends ModelAdminDecorator
{
	public function __construct(Theme $theme)
	{
		parent::__construct($theme);
	}

	public function getColumns($instance)
	{
		$value = $instance->value;

		//Add coloured box. Alternative to creating unique view
		if ($instance->key == 'backgroundcolour' || $instance->key == 'themecolour')
			$value = "<div style='padding:15px; max-width:80px; background:#".$instance->value."'></div>";

		return array(
			'Label' => $instance->label,
			'key' => $instance->key,
			'value' => $value
			);
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('name');
	}

	public function getFields()
	{

		$fields = [
		'key' 	=> array('type' => 'TextField'),
		'label' => array('type' => 'TextField')
		];

		//Only allow developers to change the key
		(Auth::user()->auth !="Developer") ? $fields['key']['params'] = ['readonly'=>'readonly'] : '';

		$switch = null;
		
		//Get URL segment for ID.
		if (Request::segment(3) != 'create'){
			$instance = $this->getByID(Request::segment(3));
			$switch = $instance->key;
		} 

		switch ($switch) {
			case 'websiteTheme':
			$fields['value'] = array(
				'type'		=> 'SelectField',
				'options'	=> $this->getThemes()
				);
			break;
			
			case 'layout':
			$fields['value'] = array(
				'type'		=> 'SelectField',
				'options'	=> $this->getLayouts()
				);
			break;

			case 'backgroundcolour':
			$fields['value'] = array(
				'type' 		=> 'TextField',
				'params' 	=> ['class'=>'color']
				);
			break;

			case 'themecolour':
			$fields['value'] = array(
				'type' 		=> 'TextField',
				'params' 	=> ['class'=>'color']
				);
			break;
			default:

			$fields['value'] = array('type' => 'TextField');
		}
		return $fields;
	}

	public function getByID( $key )
	{
		return $this->model->where('id',$key)->first();
	}

	//Get themes from directory for select
	public static function getThemes()
	{
		$folders = File::directories(app_path()."/views/themes/");
		foreach($folders as $folder) {
			$themes[basename($folder)] = basename($folder);
		}
		return $themes;
	}

	//Get layouts from directory for select
	public static function getLayouts()
	{
		$files = File::files(app_path()."/views");

		//If themes package is used
		if (Route::getRoutes()->hasNamedRoute('admin.themes.index')){
			$theme = New Theme;
			$webTheme = $theme->getByKey('websiteTheme');
			$files = File::files(app_path()."/views/themes/".$webTheme->value."/layouts/");
		}

		//Strip filename extensions
		foreach($files as $file) {
			$file = substr($file, 0, strpos($file, '.'));
			$templates[basename($file)] = basename($file);
		}
		return $templates;
	}
}
