<?php

use Illuminate\Database\Seeder;

class SaldoHutangsTableSeeder extends Seeder
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
          	'suppliers_id' 	=> 1,
          	'keterangan' 		=> 'Saldo Awal Hutang',
          	'debet' 				=> 0,
          	'kredit' 				=> 44000000,
          	'created_at' 		=> now(),
          	'updated_at' 		=> now(),
      		],
          [
            'tanggal' => now(),
          	'suppliers_id' 	=> 2,
          	'keterangan' 		=> 'Saldo Awal Hutang',
          	'debet' 				=> 0,
          	'kredit' 				=> 22000000,
          	'created_at' 		=> now(),
          	'updated_at' 		=> now(),
          ],
          [
            'tanggal' => now(),
          	'suppliers_id' 	=> 3,
          	'keterangan' 		=> 'Saldo Awal Hutang',
          	'debet' 				=> 0,
          	'kredit' 				=> 88000000,
          	'created_at' 		=> now(),
          	'updated_at' 		=> now(),
          ],
        ];
        DB::table('saldo_hutangs')->truncate();
        DB::table('saldo_hutangs')->insert($data);
    }
}
