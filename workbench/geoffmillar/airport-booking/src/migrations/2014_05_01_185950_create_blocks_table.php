<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	public function up()
	{
		Schema::create('blocks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key');
			$table->string('label');
			$table->text('content');
			$table->boolean('active');
			$table->timestamps();
		});
	}

	public function down()
	{
        Schema::drop('blocks');
	}
}
