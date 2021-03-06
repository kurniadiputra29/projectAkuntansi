<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(SaldoAwalsTableSeeder::class);
        $this->call(SaldoHutangsTableSeeder::class);
        $this->call(SaldoItemsTableSeeder::class);
        $this->call(SaldoPiutangsTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
        $this->call(LaporanBukuBesarsTableSeeder::class);
        $this->call(LaporanBukuBesarPenyesuaiansTableSeeder::class);
        $this->call(HargaJualsTableSeeder::class);
        $this->call(PemetaanAkunsTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
