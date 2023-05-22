<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([

            'name' => 'hat',
            'description' => 'a great hat',
            'amount' => 45

        ]);

        DB::table('products')->insert([

            'name' => 'shoes',
            'description' => 'great shoes',
            'amount' => 45

        ]);

        DB::table('products')->insert([

            'name' => 'gap',
            'description' => 'a great gap',
            'amount' => 45

        ]);

    }
}
