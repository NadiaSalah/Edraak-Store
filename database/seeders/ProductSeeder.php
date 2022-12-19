<?php

namespace Database\Seeders;

use App\Models\MainSubCategory;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'Lorem Ipsum is simply dummy text of the printing and typesetting';
        $description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
Lorem Ipsum has been the industry s standard dummy text ever since the 1500s,
when an unknown printer took a galley of type and scrambled it to make a type specimen book.
It has survived not only five centuries, but also the leap into electronic typesetting, 
remaining essentially unchanged. It was popularised in the 1960s with the release of
Letraset sheets containing Lorem Ipsum passages, and more recently with desktop 
publishing software like Aldus PageMaker including versions of Lorem Ipsum';
        $path = 'assets/images/products/';
        $view = array('normal', 'hot');
        $return = array(true, false);

        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => ($i + 1) . $name,
                'description' => $description,
                'image' => $path . ($i + 1) . '.jpg',
                'quantity' => rand(0, 100),
                'price' => rand(50, 1000),
                'discount' => rand(0, 45),
                'view' => $view[rand(0, 1)],
                'return' =>  $return[rand(0, 1)],
                'main_sub_category_id' =>"".rand(1, getMainCategories()->count()),
                'created_at' => now(),
            ]);
        }
    }
}
