<?php namespace GeoffMillar\Admin\Controllers;

use GeoffMillar\Admin\Models\Page;
use GeoffMillar\Admin\Models\Setting;
use GeoffMillar\Theme\Models\Theme;
use GeoffMillar\Slider\Models\Slider;
use GeoffMillar\ContentBlock\Models\Block;
use View,Route,BaseController,DB;

class PageController extends BaseController
{

	protected $setting;
	protected $theme;
	protected $page;
	protected $block;
	protected $slider;

	public function __construct(Setting $setting, Theme $theme, Page $page, Block $block, Slider $slider)
	{
		$this->setting 	= $setting;
		$this->theme 	= $theme;
		$this->page 	= $page;
		$this->block 	= $block;
		$this->slider 	= $slider;
	}

	public function show($slug)
	{
		//Get page
		$page = $this->page->where('slug', $slug)->firstOrFail();
		//Get navigation
		$navigation = $this->page->select('title', 'slug', 'navigation')->get();
		//Set the view route
		$route = $page->template;
		//Get settings as object
		$settings =  $this->setting->convert();
		//If slider package is exists
		$slider = isset($this->slider) ? $this->slider->get() : '';
	
		//If theme package exists
		if (isset($this->theme)){
			//Get themes and merge with settings
			$themes =  $this->theme->convert();
			$route = 'themes.'.$themes->websiteTheme.'.'.$page->template;
			$settings = (object) array_merge((array) $settings, (array) $themes);
		}

		//Unique to Airport operator
		$blockedDates = DB::table('blocked_date')->get();

		return View::make($route, compact('page','settings','navigation', 'slider', 'blockedDates'));
	}
}
