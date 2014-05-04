<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use GeoffMillar\Admin\Models\User;

class CreateAdminUser extends Migration {

	public function up()
	{
		$user = new User();
		$user->fill(array(
			'username' => 'admin',
			'email' => 'admin@geoffmillar.co.uk',
			'name' => 'GeoffMillar Admin'
		));
		$user->password = 'gukbeb6s';
		$user->save();
	}

	public function down()
	{
		User::where('email', '=', 'admin@geoffmillar.co.uk')->delete();
	}
}
