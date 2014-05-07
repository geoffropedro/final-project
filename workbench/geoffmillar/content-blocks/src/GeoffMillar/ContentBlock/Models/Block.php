<?php namespace GeoffMillar\ContentBlock\Models;

use Eloquent;
use GeoffMillar\ContentBlock\Validators\BlockValidator;
use GeoffMillar\Admin\Models\Base;
use Input;

class Block extends Base
{
	protected $table = 'blocks';
	protected $fillable = array('key', 'label', 'content', 'active');

	public function getValidator()
	{
		return new BlockValidator;
	}

	public static function getBlock($key)
	{        
		$block = Block::where('key','=',$key)->first();
		$result = '';

		if ($block->active)
			$result = $block->content;

		return $result;
	}
}
