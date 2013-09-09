<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			array('email' => 'test@test.com', 'password' => Hash::make('test'))
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
