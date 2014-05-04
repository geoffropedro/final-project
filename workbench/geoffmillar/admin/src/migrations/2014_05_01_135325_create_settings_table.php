<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key',255);
			$table->string('label',255);
			$table->string('value',255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');

	}
}
