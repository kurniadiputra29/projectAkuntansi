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
				'unit'    			=> '40',
				'harga'    			=> '2000000',
				'nilai_persediaan'  => '80000000',
				'gambar'    		=> '',
				'created_at'    	=> now(),
				'updated_at'    	=> now(),
			],
			[
				'kode'         		=> 'AU-N08',
				'nama'          	=> 'AC',
				'unit'    			=> '40',
				'harga'    			=> '2500000',
				'nilai_persediaan'  => '100000000',
				'gambar'    		=> '',
				'created_at'    	=> now(),
				'updated_at'    	=> now(),
			],
		];
		DB::table('items')->truncate();
		DB::table('items')->insert($data);
    }
}
