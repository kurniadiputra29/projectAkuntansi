<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
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
				'kode'         	=> 'C-0001',
				'nama'          => 'Toko Sanex',
				'npwp'    		=> '',
				'alamat'    	=> 'Yogyakarta',
				'telepon'    	=> '085945432XXX',
				'termin'    	=> '1/10 net 30',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				'kode'         	=> 'C-0002',
				'nama'          => 'Toko Niaga',
				'npwp'    		=> '',
				'alamat'    	=> 'Solo',
				'telepon'    	=> '085945654XXX',
				'termin'    	=> '1/10 net 30',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				'kode'         	=> 'C-0003',
				'nama'          => 'Toko Contoh',
				'npwp'    		=> '',
				'alamat'    	=> 'Semarang',
				'telepon'    	=> '085945765XXX',
				'termin'    	=> '1/10 net 30',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				'kode'         	=> 'C-0004',
				'nama'          => 'Toko Kent',
				'npwp'    		=> '',
				'alamat'    	=> 'Wonogiri',
				'telepon'    	=> '085945523XXX',
				'termin'    	=> '1/10 net 30',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
		];
		DB::table('data_customers')->truncate();
		DB::table('data_customers')->insert($data);
	
    }
}
