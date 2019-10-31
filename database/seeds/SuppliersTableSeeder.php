<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
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
				'kode'         	=> 'S-0001',
				'nama'          => 'PT Alam Sutra',
				'npwp'    		=> '',
				'alamat'    	=> 'Yogyakarta',
				'telepon'    	=> '085945123XXX',
				'termin'    	=> '2/10 net 50',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				'kode'         	=> 'S-0002',
				'nama'          => 'PT Nirwana',
				'npwp'    		=> '',
				'alamat'    	=> 'Solo',
				'telepon'    	=> '085945974XXX',
				'termin'    	=> '2/10 net 50',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
			[
				'kode'         	=> 'S-0003',
				'nama'          => 'PT Intan Tri Guna',
				'npwp'    		=> '',
				'alamat'    	=> 'Semarang',
				'telepon'    	=> '085945321XXX',
				'termin'    	=> '2/10 net 50',
				'created_at'    => now(),
				'updated_at'    => now(),
			],
		];
		DB::table('data_suppliers')->truncate();
		DB::table('data_suppliers')->insert($data);
    }
}
