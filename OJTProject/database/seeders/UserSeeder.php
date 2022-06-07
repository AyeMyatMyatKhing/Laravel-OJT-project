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
            'name'=> 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('A1234567'),
            'type' => '0',
            'phone' => '091234567',
            'address' => 'No9/B,53th street,Yangon',
            'dob' => '1999-01-10',
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at'=>'2022-06-02 10:27:49',
            'updated_at' => '2021-06-02 10:27:49'
        ]);

        DB::table('users')->insert([
            'name'=> 'Aye Aye',
            'email' => 'ayeaye@gmail.com',
            'password' => Hash::make('A1234567'),
            'type' => '1',
            'phone' => '0934243546',
            'address' => 'No11/B,51th street,Yangon',
            'dob' => '1999-04-13',
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at'=>'2022-06-02 10:27:49',
            'updated_at' => '2021-06-02 10:27:49'
        ]);

        DB::table('users')->insert([
            'name'=> 'Mya Mya',
            'email' => 'myamya@gmail.com',
            'password' => Hash::make('A1234567'),
            'type' => '1',
            'phone' => '0939842908',
            'address' => 'No11,43th street,Yangon',
            'dob' => '1988-01-19',
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at'=>'2022-06-02 10:27:49',
            'updated_at' => '2021-06-02 10:27:49'
        ]);

        DB::table('users')->insert([
            'name'=> 'Aung Aung',
            'email' => 'aungaung@gmail.com',
            'password' => Hash::make('A1234567'),
            'type' => '0',
            'phone' => '0998329482',
            'address' => 'No9/B,53th street,Yangon',
            'dob' => '1995-06-17',
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at'=>'2022-06-02 10:27:49',
            'updated_at' => '2021-06-02 10:27:49'
        ]);
    }
}
