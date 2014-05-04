<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');

			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('name');
			$table->string('auth');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}