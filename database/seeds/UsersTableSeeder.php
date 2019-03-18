<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = new \App\User();
        $record->name = 'کاربر مدیر';
        $record->email ='admin@email.com';
        $record->password = bcrypt('123456');
        $record->save();
    }
}
