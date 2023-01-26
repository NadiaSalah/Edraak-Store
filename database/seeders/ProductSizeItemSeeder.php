<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSizeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 0; $i < 20; $i++) {
        //     DB::table('product_size_items')->insert([
        //         'product_id' =>$i+1,
        //         'size_id'=>"".rand(1,6),
        //     ]);
        // }

        foreach (Product::all() as $p) {
            if (rand(0, 1)) {
                foreach (Size::all() as $s) {
                    if ($s->name != 'no') {
                        DB::table('product_size_items')->insert([
                            'product_id' => $p->id,
                            'size_id' => $s->id,
                        ]);
                    }
                }
            } else {
                DB::table('product_size_items')->insert([
                    'product_id' => $p->id,
                    'size_id' => Size::where('name','no')->first()->id,
                ]);
            }
        }
    }
}
