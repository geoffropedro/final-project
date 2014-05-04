<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration {

	public function up()
	{
		Schema::create('slider', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('image');
			$table->string('content');
			$table->boolean('active');
			$table->timestamps();
		});
	}

	public function down()
	{
        Schema::drop('slider');
	}
}
