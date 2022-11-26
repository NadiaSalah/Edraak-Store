<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MainCategory;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class, //add admin in database automatically 
            MainCategorySeeder::class, //add main categories in database automatically 
            SubCategorySeeder::class, //add sub categories in database automatically 
            MainSubCategorySeeder::class, //add main_sub categories in database automatically 
            SizeSeeder::class, //add sizes categories in database automatically 

        ]);
    }
}
