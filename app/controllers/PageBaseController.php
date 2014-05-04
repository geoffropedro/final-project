<?php

use GeoffMillar\Admin\Models\Page;
use GeoffMillar\Admin\Models\Setting;
use GeoffMillar\Theme\Models\Theme;
use GeoffMillar\Slider\Models\Slider;
use GeoffMillar\ContentBlock\Models\Block;


class PageBaseController extends BaseController {

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

}