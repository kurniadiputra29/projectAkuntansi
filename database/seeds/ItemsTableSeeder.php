<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
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
				'kode'         		=> 'AU-N06',
				'nama'          	=> 'Lemari Es',
				'created_at'    	=> now(),
				'updated_at'    	=> now(),
			],
			[
				'kode'         		=> 'AU-N08',
				'nama'          	=> 'AC',
				'created_at'    	=> now(),
				'updated_at'    	=> now(),
			],
		];
		DB::table('items')->truncate();
		DB::table('items')->insert($data);
    }
}
