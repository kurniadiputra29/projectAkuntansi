<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          ['nama' => 'Admin'],
          ['nama' => 'Akuntan Pembantu'],
        ];
        DB::table('roles')->truncate();
        DB::table('roles')->insert($data);
    }
}
