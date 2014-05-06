<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function($table) {
			$table->increments('id');
			$table->string('title');
			$table->string('firstname');
			$table->string('surname');
			$table->string('address_line1');
			$table->string('address_line2');
			$table->string('post_town');
			$table->string('postcode');
			$table->string('contact_num');
			$table->string('alt_phone');
			$table->string('email');
			$table->string('joined');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}

