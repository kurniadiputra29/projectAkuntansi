<?php

use Illuminate\Database\Seeder;

class LaporanPiutangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        [
			[
				'customers_id' => 1,
				'saldo_piutangs_id' => 1,
				'salesjournal_id' => null,
				'retur_penjualan_id' => null,
				'cash_bank_ins_id' => null,
				'debet' => 44000000,
				'kredit' => 0,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'customers_id' => 2,
				'saldo_piutangs_id' => 2,
				'salesjournal_id' => null,
				'retur_penjualan_id' => null,
				'cash_bank_ins_id' => null,
				'debet' => 33000000,
				'kredit' => 0,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'customers_id' => 4,
				'saldo_piutangs_id' => 3,
				'salesjournal_id' => null,
				'retur_penjualan_id' => null,
				'cash_bank_ins_id' => null,
				'debet' => 33000000,
				'kredit' => 0,
				'created_at' => now(),
				'updated_at' => now(),
			],
		];
		DB::table('laporan_piutangs')->truncate();
		DB::table('laporan_piutangs')->insert($data);
    }
}
