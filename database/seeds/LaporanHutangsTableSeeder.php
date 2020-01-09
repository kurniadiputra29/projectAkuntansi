<?php

use Illuminate\Database\Seeder;

class LaporanHutangsTableSeeder extends Seeder
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
          	'suppliers_id' 	=> 1,
          	'saldo_hutangs_id' => 1,
          	'purchasejournal_id' => null,
            'retur_pembelian_id' => null,
          	'cash_bank_outs_id' => null,
          	'debet' => 0,
          	'kredit' => 44000000,
          	'created_at' => now(),
          	'updated_at' => now(),
      		],
          [
          	'suppliers_id' => 2,
          	'saldo_hutangs_id' => 2,
          	'purchasejournal_id' => null,
          	'retur_pembelian_id' => null,
            'cash_bank_outs_id' => null,
          	'debet' => 0,
          	'kredit' => 22000000,
          	'created_at' => now(),
          	'updated_at' => now(),
          ],
          [
          	'suppliers_id' => 3,
          	'saldo_hutangs_id' => 3,
          	'purchasejournal_id' => null,
          	'retur_pembelian_id' => null,
            'cash_bank_outs_id' => null,
          	'debet' => 0,
          	'kredit' => 88000000,
          	'created_at' => now(),
          	'updated_at' => now(),
          ],
        ];
        DB::table('laporan_hutangs')->truncate();
        DB::table('laporan_hutangs')->insert($data);
    }
}
