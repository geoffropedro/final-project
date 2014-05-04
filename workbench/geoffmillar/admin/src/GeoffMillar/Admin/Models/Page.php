<?php namespace GeoffMillar\Admin\Models;

use GeoffMillar\Admin\Services\Validators\PageValidator;
use Str;

class Page extends Base
{
	protected $fillable = array('title', 'slug', 'content','template','metatitle','metadescription','navigation');

	public function getValidator()
	{
		return new PageValidator;
	}

	public function setSlugAttribute($value)
	{
		if ($value != "/")
			$this->attributes['slug'] = Str::slug($value);
	}
}