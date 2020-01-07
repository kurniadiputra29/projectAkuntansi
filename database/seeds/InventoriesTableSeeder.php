<?php

use Illuminate\Database\Seeder;

class InventoriesTableSeeder extends Seeder
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
						'items_id' 						=> 1,
						'saldo_items_id' 			=> 1,
						'crj_id' 							=> null,
						'cpj_id' 							=> null,
						'purchasejournal_id' 	=> null,
						'salesjournal_id' 		=> null,
						'retur_penjualan_id' 	=> null,
						'retur_pembelian_id' 	=> null,
						'status' 							=> 1,
						'unit' 								=> 40,
						'price' 							=> 2000000,
						'total' 							=> 80000000,
						'created_at' 					=> now(),
						'updated_at' 					=> now(),
					],
					[
						'items_id' 						=> 2,
						'saldo_items_id' 			=> 2,
						'crj_id' 							=> null,
						'cpj_id' 							=> null,
						'purchasejournal_id' 	=> null,
						'salesjournal_id' 		=> null,
						'retur_penjualan_id' 	=> null,
						'retur_pembelian_id' 	=> null,
						'status' 							=> 1,
						'unit' 								=> 40,
						'price' 							=> 2500000,
						'total' 							=> 100000000,
						'created_at' 					=> now(),
						'updated_at' 					=> now(),
					],
				];
				DB::table('inventories')->truncate();
				DB::table('inventories')->insert($data);
    }
}
