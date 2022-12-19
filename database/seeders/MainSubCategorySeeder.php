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
        foreach (getMainCategories() as $main) {
            foreach (getsubCategories() as $sub) {
                DB::table('main_sub_categories')->create([
                    'main_category_id' => $main->id,
                    'sub_category_id' => $sub->id,
                ]);
            }
        }
    }
}
