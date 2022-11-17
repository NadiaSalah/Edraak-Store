<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 1,
            'sub_category_id'=>1
        ]);

        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 1,
            'sub_category_id'=>2
        ]);
        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 1,
            'sub_category_id'=>3
        ]);
        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 2,
            'sub_category_id'=>1
        ]);
        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 2,
            'sub_category_id'=>3
        ]);
        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 3,
            'sub_category_id'=>4
        ]);
        DB::table('main_sub_categories')->insert([
            'main_category_id'=> 3,
            'sub_category_id'=>5
        ]);
    }
}
