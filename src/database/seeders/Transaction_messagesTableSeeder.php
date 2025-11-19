<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Transaction_messagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_messages')->insert([
            [
                'transaction_id' => 1,
                'sender_id' => 2,
                'message' => '購入しました。よろしくお願いします。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 1,
                'sender_id' => 1,
                'message' => '承知しました。発送準備をします。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
