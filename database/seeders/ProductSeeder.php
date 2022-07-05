<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name' => Str::random(10),
            'desc' => 'lorem sdusd uhuhuhs sds ds ds dd sds',
            'category_id' => 1,
            'inventory_id' => 1,
            'price' => 30000,
            'weight' => 1.2
        ]);
    }
}
