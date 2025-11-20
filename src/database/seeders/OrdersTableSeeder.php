<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'user_id' => 2,
                'product_id' => 1,
                'method' => 'カード払い',
                'post' => '123-4567',
                'address' => '東京都新宿区1-1-1',
                'building' => 'ビル101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'product_id' => 2,
                'method' => 'コンビニ払い',
                'post' => '234-5678',
                'address' => '大阪府大阪市2-2-2',
                'building' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 6,
                'method' => 'コンビニ払い',
                'post' => '234-5678',
                'address' => '大阪府大阪市2-2-2',
                'building' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
