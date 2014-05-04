<?php namespace GeoffMillar\Admin\Decorators;

use GeoffMillar\Admin\Models\Page;
use GeoffMillar\Theme\Models\Theme;
use Illuminate\Support\Facades\HTML;
use File, Route;

class PageAdminDecorator extends ModelAdminDecorator
{
	protected $templateFields;

	public function __construct(Page $page)
	{
		parent::__construct($page);
		$this->templateFields = $this->getTemplates();
	}

	public static function getTemplates()
	{
		$files = File::files(app_path()."/views");

		if (Route::getRoutes()->hasNamedRoute('admin.themes.index')){
			$theme = New Theme;
			$theme = $theme->getByKey('websiteTheme');
			$files = File::files(app_path()."/views/themes/".$theme->value);
		}

		$templates = array();

		foreach($files as $file) {
			$file = substr($file, 0, strpos($file, '.'));
			$templates[basename($file)] = basename($file);
		}
		return $templates;
	}

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

	public function getLabel($instance)
	{
		return $instance->getAttribute('title');
	}

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
				'options' 		=> $this->templateFields
				),

			'content' 			=> array(
				'label' 		=> 'Description',
				'type' 			=> 'TextareaField',
				'title' 		=> 'wysiwyg'
				)
			);
	}
}
