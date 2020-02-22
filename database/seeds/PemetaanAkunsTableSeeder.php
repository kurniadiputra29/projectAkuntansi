<?php

use Illuminate\Database\Seeder;

class PemetaanAkunsTableSeeder extends Seeder
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
    			'inventory' => 6,
    			'penjualan_cash' => 29,
    			'penjualan_credit' => 30,
    			'hpp_penjualan_cash' => 34,
    			'hpp_penjualan_credit' => 35,
    			'ppn_penjualan' => 22,
    			'ppn_pembelian' => 23,
    			'pengiriman_penjualan' => 31,
    			'pengiriman_pembelian' => 36,
    			'diskon_penjualan' => 33,
    			'diskon_pembelian' => 37,
                'cash' => 1,
                'hutang' => 18,
                'piutang' => 4,
                'kas_kecil' => 2,
    			'created_at' => now(),
    			'updated_at' => now(),
    		],
    	];
    	DB::table('pemetaan_akuns')->truncate();
    	DB::table('pemetaan_akuns')->insert($data);
    }
}
