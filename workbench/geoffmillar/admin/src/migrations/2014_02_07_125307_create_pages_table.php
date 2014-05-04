<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->text('metatitle');
            $table->text('metadescription');
            $table->text('template');
            $table->string('navigation');
            $table->timestamps();
		});
	}

	public function down()
	{
        Schema::drop('pages');
	}
}
