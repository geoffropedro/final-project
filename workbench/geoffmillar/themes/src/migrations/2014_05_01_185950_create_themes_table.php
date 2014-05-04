<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration {

	//Create table
	public function up()
	{
		Schema::create('themes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key',255);
			$table->string('label',255);
			$table->string('value',255);
			$table->timestamps();
		});
	}

	//Drop table
	public function down()
	{
        Schema::drop('themes');
	}
}
