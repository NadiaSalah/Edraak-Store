<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            'name'=>'Jackets'  
        ]);
        DB::table('sub_categories')->insert([
            'name'=>'Pants'  
        ]);
        DB::table('sub_categories')->insert([
            'name'=>'Sweaters & Shirts'  
        ]);
        DB::table('sub_categories')->insert([
            'name'=>'Shoes'  
        ]);
        DB::table('sub_categories')->insert([
            'name'=>'Bags'  
        ]);
        DB::table('sub_categories')->insert([
            'name'=>'Accessories'  
        ]);
    }
}
