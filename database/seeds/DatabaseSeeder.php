<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClienteTableSeeds::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SistemaTableSeeder::class);
    }
}
