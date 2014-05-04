<?php  namespace GeoffMillar\Admin\Database\Seeds;

use GeoffMillar\Admin\Models\User;

class UserTableSeeder extends \Seeder
{
	public function run()
	{
		User::create(array(
			'id' => 2,
			'username' => 'Millar',
			'email' => 'geoff@pixperfect.co.uk',
			'password' => 'really secure password',
			'name' => 'Geoff Millar',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));
	}
}
