<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'seller_id' => 1,
                'buyer_id' => 2,
                'status' => 1,
                'last_message_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 2,
                'seller_id' => 2,
                'buyer_id' => 3,
                'status' => 1,
                'last_message_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
