<?php namespace GeoffMillar\ContentBlock\Controllers;

use GeoffMillar\Admin\Controllers\ModelAdminController;
use GeoffMillar\ContentBlock\Decorators\BlockAdminDecorator;
use Auth;

class ContentBlockAdminController extends ModelAdminController
{
	public function __construct(BlockAdminDecorator $block)
	{
		parent::__construct($block);
		(Auth::user()->auth != 'Developer') ? $this->editable = false : null;
	}
}
