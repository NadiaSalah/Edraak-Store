<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'=>'edraak',
            'last_name'=>'store',
            'email'=>'admin@edraakmc.com',
            'password'=> Hash::make('edraakMC_admin'),
            'role'=>0,
            'status'=>true
        ]);
        
    }
}
