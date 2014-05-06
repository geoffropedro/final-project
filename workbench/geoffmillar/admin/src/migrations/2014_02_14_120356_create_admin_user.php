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
			'email' => 'geoff@pixperfect.co.uk',
			'name' => 'GeoffMillar Admin'
		));
		$user->password = 'password';
		$user->save();
	}

	public function down()
	{
		User::where('email', '=', 'geoff@pixperfect.co.uk')->delete();
	}
}
