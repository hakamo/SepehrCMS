<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = new \App\products();
        $products->product_title = 'title';
        $products->product_description ='description';
        $products->product_page_url = 'http://www.xyz.com';
        $products->product_picture_url = 'picture url';
        $products->language = 'fa';
        $products->save();
    }
}
