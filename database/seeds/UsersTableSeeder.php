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
						'foto'      	=> 'public/foto/wuLMJ1CEOorGeCf7yUNDQ0K31oZh2Eeev5SNp4IF.jpeg',
						'role'			=> 'admin',
						'created_at'    => now(),
						'updated_at'    => now(),
				];
				DB::table('users')->truncate();
				DB::table('users')->insert($data);
		}
}
