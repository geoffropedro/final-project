<?php namespace GeoffMillar\ContentBlock\Decorators;

use GeoffMillar\Admin\Decorators\ModelAdminDecorator;
use GeoffMillar\ContentBlock\Models\Block;
use Illuminate\Config\Repository;
use Auth;

class BlockAdminDecorator extends ModelAdminDecorator
{
	public function __construct(Block $block)
	{
		parent::__construct($block);
	}
	
	public function getColumns($instance)
	{
		$active = ($instance->active == 1) ? 'Yes' : 'No';

		return array(
			'ID' => $instance->id,
			'Key' => $instance->key,
			'Label' => $instance->label,
			'Active' => $active
			);
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('title');
	}

	public function getFields()
	{
		$fields = [
		'key' 		=> array('label' => 'Block key','type' 	=> 'TextField'),
		'label' 	=> array('label' => 'Label','type' 		=> 'TextField',),
		'content' 	=> array('label' => 'Content','type' 	=> 'TextareaField','title' 	=> 'wysiwyg'),
		'active' 	=> array('label' => 'Active','type'		 => 'SelectField','options' => ['1'=>'Yes','0'=>'No']),	
		];

		//Only allow developers to change the key
		(Auth::user()->auth !="Developer") ? $fields['key']['params'] = ['readonly'=>'readonly'] : null;

		return $fields;
	}
}
