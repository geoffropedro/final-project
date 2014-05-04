<?php namespace GeoffMillar\Theme\Controllers;

use GeoffMillar\Admin\Controllers\ModelAdminController;
use GeoffMillar\Theme\Decorators\ThemeAdminDecorator;
use Auth, Input, DB, File, Redirect;
use scssc;

class ThemeAdminController extends ModelAdminController
{
	public function __construct(ThemeAdminDecorator $theme)
	{
		parent::__construct($theme);
		(Auth::user()->auth != 'Developer') ? $this->editable = false : null;
	}

	//Override update
	public function update($id)
	{
		$modelInstance = $this->decorator->getModel()->find($id);
		$validation = $this->decorator->getModel()->getValidator();
		$validation->updateUniques($modelInstance->getId());
		$input = Input::all();

		if ($validation->passesEdit($input)) {
			$modelInstance->fill($input);
			
			$modelInstance->save();

			if ($input['key'] == 'websiteTheme')
			{
				//Get all layouts from directory
				$files = File::files(app_path()."/views/themes/".$input['value']."/layouts/");
				//Use the first found. Only the file name
				$file = basename($files[0]);
				//Remove extension
				$fileStripped = substr($file, 0, strpos($file, '.'));
				//Update layout in DB
				DB::table('themes')->where('key', 'layout')->update(array('value' => $fileStripped));
			}

			//Added functionality starts to create css file from scss.
			if ($input['key']=='backgroundcolour' || $input['key']=='themecolour')
			{
				//Get existing
				$backgroundColour 	= DB::table('themes')->where('key', 'backgroundcolour')->first();
				$themeColour 		= DB::table('themes')->where('key', 'themecolour')->first();
				//Calculate link colour
				$navLinkColour 		= (hexdec($themeColour->value) > 0xffffff/2) ? 'black':'white';
				//Generate scss contents
				$contents  = '$backgroundColor: #'.$backgroundColour->value.';';
				$contents .= '$themeColor1: #'.$themeColour->value.';';
				$contents .= '$navColour: '.$navLinkColour.';';
				//Write scss cmsrewrite file
				File::put(app_path()."/assets/scss/_rewrite.scss", $contents);
				//Compile new css file
				$scss = new scssc();
				$scss->setImportPaths(app_path()."/assets/scss/");

				$scss->setFormatter('scss_formatter_compressed'); 

				File::put(base_path()."/public/css/style.min.css", $scss->compile('@import "application.scss"'));
			}
			$response = Redirect::action(get_class($this) . '@index');
		} else {
			$response = Redirect::back()->withErrors($validation->getErrors())->withInput();
		}
		return $response;
	}
}
