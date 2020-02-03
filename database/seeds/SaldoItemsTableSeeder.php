<?php

use Illuminate\Database\Seeder;

class SaldoItemsTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				$data = [
					[
						'tanggal' => now(),
						'items_id' 			=> 1,
						'unit' 					=> 40,
						'price' 				=> 2000000,
						'total' 				=> 80000000,
						'created_at' 		=> now(),
						'updated_at' 		=> now(),
					],
					[
						'tanggal' => now(),
						'items_id' 			=> 2,
						'unit' 					=> 40,
						'price' 				=> 2500000,
						'total' 				=> 100000000,
						'created_at' 		=> now(),
						'updated_at' 		=> now(),
					],
				];
				DB::table('saldo_items')->truncate();
				DB::table('saldo_items')->insert($data);
		}
}
