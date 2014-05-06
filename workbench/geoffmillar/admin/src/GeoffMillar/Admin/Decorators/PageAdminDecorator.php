<?php namespace GeoffMillar\Admin\Decorators;

use GeoffMillar\Admin\Models\Page;
use GeoffMillar\Theme\Models\Theme;
use Illuminate\Support\Facades\HTML;
use File, Route, Auth;

class PageAdminDecorator extends ModelAdminDecorator
{
	protected $templateFields;

	//Construct parent and get the select template fields
	public function __construct(Page $page)
	{
		parent::__construct($page);
		$this->templateFields = $this->getTemplates();
	}

	//Scan directory for templates
	public static function getTemplates()
	{
		//If developer get all templates
		if (Auth::user()->auth == "Developer")
		{
			$files = File::files(app_path()."/views");

			//If themes package is being used
			if (Route::getRoutes()->hasNamedRoute('admin.themes.index')){
				$theme = New Theme;
				$theme = $theme->getByKey('websiteTheme');
				$files = File::files(app_path()."/views/themes/".$theme->value);
			}

			$templates = array();

			//Add to tempolates array
			foreach($files as $file) {
				$file = substr($file, 0, strpos($file, '.'));
				$templates[basename($file)] = basename($file);
			}

		} 
		else 
		{
			//Only return the page template
			$templates['page'] = 'page';
		}
		return $templates;
	}

	//Return view columns
	public function getColumns($instance)
	{
		return array(
			'ID' 				=> $instance->id,
			'Title' 			=> $instance->title,
			'URL' 				=> HTML::link($instance->slug),
			'Slug' 				=> $instance->slug,
			'Main navigation' 	=> $instance->navigation
			);
	}

	//Get the form label
	public function getLabel($instance)
	{
		return $instance->getAttribute('title');
	}

	//Get the form fields
	public function getFields()
	{
		return array(
			'title' 			=> array(
				'label' 		=> 'Title',
				'type' 			=> 'TextField',
				),
			'slug' 				=> array(
				'label' 		=> 'Slug',
				'type' 			=> 'TextField',
				),
			'metatitle' 		=> array(
				'label' 		=> 'Meta title',
				'type' 			=> 'TextField',
				),

			'metadescription' 	=> array(
				'label' 		=> 'Meta description',
				'type' 			=> 'TextField',
				),

			'navigation' 		=> array(
				'label' 		=> 'Navigation',
				'type' 			=> 'SelectField',
				'options' 		=> ['main'=>'Main','dropdown'=>'Dropdown', 'none'=>'None']
				),

			'template' 			=> array(
				'label' 		=> 'Template',
				'type' 			=> 'SelectField',
				'options' 		=> $this->templateFields,
				'params'		=> ['selected'=>'page']
				),

			'content' 			=> array(
				'label' 		=> 'Description',
				'type' 			=> 'TextareaField',
				'title' 		=> 'wysiwyg'
				)
			);
	}
}
