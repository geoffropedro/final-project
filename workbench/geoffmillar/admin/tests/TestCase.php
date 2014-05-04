<?php namespace GeoffMillar\Admin\Tests;

use Artisan, Mail;

class TestCase extends \TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->prepareForTests();
	}

	private function prepareForTests()
	{
		$option = strpos(__DIR__, 'workbench') === false ? '--package' : '--bench';

		Artisan::call('migrate', array($option => 'geoffmillar/admin'));
		Artisan::call('db:seed');
		Mail::pretend(true);
	}
}
