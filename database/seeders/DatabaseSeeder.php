<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       

        // \App\Models\User::factory()->create([
        //     'first_name' => 'edraak',
        //     'last_name' => 'store',
        //     'email' => 'user@edraakstore.com',
        // ]);

        $this->call([
            UserSeeder::class, //add admin in database automatically
            AddressSeeder::class, //add Addressfor users in database automatically 
            SizeSeeder::class, //add sizes in database automatically
            MainCategorySeeder::class, //add main categories in database automatically 
            SubCategorySeeder::class, //add subcategories in database automatically 
            MainSubCategorySeeder::class, //add main_sub categories in database automatically 
            ProductSeeder::class, //add Products in database automatically  
            ProductSizeItemSeeder::class, //add Product sizes in database automatically 
             
        ]);

        \App\Models\User::factory(10)->create();
    }
}
