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
        $this->call(UsersTableSeeder::class);

        $this->call(ProductTableSeeder::class);

        $this->call(SlideTableSeeder::class);

        $this->call(SysParamTableSeeder::class);
    }
}
