<?php

use Illuminate\Database\Seeder;

class HargaJualsTableSeeder extends Seeder
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
				'items_id' => '1',
				'harga_jual' => 2500000,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'items_id' => '2',
				'harga_jual' => 3000000,
				'created_at' => now(),
				'updated_at' => now(),
			],
		];
		DB::table('harga_juals')->truncate();
		DB::table('harga_juals')->insert($data);
    }
}
