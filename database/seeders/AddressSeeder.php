<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'name' => 'home',
            'phone' => "3862538897",
            'address_line_1' => '1628 S Atlantic Ave',
            'address_line_2' => '2nd floor',
            'city' => 'Daytona Beach',
            'state' => 'Florida',
            'country' => 'United States',
            'postal_code' => '32118',
            'user_id' =>  '2'
        ]);
        DB::table('addresses')->insert([
            'name' => 'work',
            'phone' => "3862538897",
            'address_line_1' => '2775 Crossroads Blvd',
            'address_line_2' => '2nd floor',
            'city' => 'Grand Junction',
            'state' => 'Colorado',
            'country' => 'United States',
            'postal_code' => '81506',
            'user_id' => '2'
        ]);
        DB::table('addresses')->insert([
            'name' => 'my home',
            'phone' => "8886926841",
            'address_line_1' => '10 S Mickley Ave',
            'address_line_2' => '3rd floor',
            'city' => 'Indianapolis',
            'state' => 'Iowa',
            'country' => 'United States',
            'postal_code' => '46241',
            'user_id' =>  '3'
        ]);
    }
}
