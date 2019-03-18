<?php

use Illuminate\Database\Seeder;

class SlideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $action = new  \App\Slide();
        $action->ButtonTitle =  'title';
        $action->Description = 'desc';
        $action->FilePath = 'path';
        $action->Title = 'title';
        $action->itemUrl = '#';
        $action->language = 'fa';
        $action->save();
    }
}
