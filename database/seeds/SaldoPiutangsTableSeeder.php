<?php

use Illuminate\Database\Seeder;

class SaldoPiutangsTableSeeder extends Seeder
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
						'customers_id' 	=> 1,
						'keterangan' 		=> 'Saldo Awal Piutang',
						'debet' 				=> 44000000,
						'kredit' 				=> 0,
						'created_at' 		=> now(),
						'updated_at' 		=> now(),
					],
					[
						'tanggal' => now(),
						'customers_id' 	=> 2,
						'keterangan' 		=> 'Saldo Awal Piutang',
						'debet' 				=> 33000000,
						'kredit' 				=> 0,
						'created_at' 		=> now(),
						'updated_at' 		=> now(),
					],
					[
						'tanggal' => now(),
						'customers_id' 	=> 4,
						'keterangan' 		=> 'Saldo Awal Piutang',
						'debet' 				=> 33000000,
						'kredit' 				=> 0,
						'created_at' 		=> now(),
						'updated_at' 		=> now(),
					],
				];
				DB::table('saldo_piutangs')->truncate();
				DB::table('saldo_piutangs')->insert($data);
		}
}
