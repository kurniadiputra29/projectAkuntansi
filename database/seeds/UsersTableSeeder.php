<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				$data = [
						'nama'          => 'Coba',
						'email'         => 'coba@gmail.com',
						'password'      => bcrypt('12345'),
						'foto'      => '',
						'created_at'    => now(),
						'updated_at'    => now(),
				];
				DB::table('users')->truncate();
				DB::table('users')->insert($data);
		}
}
