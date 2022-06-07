<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i < 10; $i++){
            DB::table('posts')->insert([
                'title'=>Str::random(15),
                'description'=>Str::random(50),
                'status' => 0,
                'created_user_id'=> 1,
                'created_at' => now()
            ]);
        }
    }
}
