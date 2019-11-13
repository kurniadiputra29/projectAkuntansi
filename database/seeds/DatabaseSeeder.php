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
        $this->call(UsersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(SaldoAwalSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
