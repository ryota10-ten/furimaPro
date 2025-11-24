<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // 商品データ配列
        $products = [
            [
                'name' => '腕時計',
                'brand' => 'A',
                'img' => 'Armani+Mens+Clock.jpg',
                'price' => 15000,
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'condition_id' => 1,
            ],
            [
                'name' => 'HDD',
                'brand' => 'A',
                'img' => 'HDD+Hard+Disk.jpg',
                'price' => 5000,
                'detail' => '高速で信頼性の高いハードディスク',
                'condition_id' => 2,
            ],
            [
                'name' => '玉ねぎ3束',
                'brand' => 'A',
                'img' => 'iLoveIMG+d.jpg',
                'price' => 300,
                'detail' => '新鮮な玉ねぎ3束のセット',
                'condition_id' => 3,
            ],
            [
                'name' => '革靴',
                'brand' => 'A',
                'img' => 'Leather+Shoes+Product+Photo.jpg',
                'price' => 4000,
                'detail' => 'クラシックなデザインの革靴',
                'condition_id' => 3,
            ],
            [
                'name' => 'ノートPC',
                'brand' => 'A',
                'img' => 'Living+Room+Laptop.jpg',
                'price' => 45000,
                'detail' => '高性能なノートパソコン',
                'condition_id' => 1,
            ],
            [
                'name' => 'マイク',
                'brand' => 'A',
                'img' => 'Music+Mic+4632231.jpg',
                'price' => 8000,
                'detail' => '高音質のレコーディング用マイク',
                'condition_id' => 2,
            ],
            [
                'name' => 'ショルダーバッグ',
                'brand' => 'A',
                'img' => 'Purse+fashion+pocket.jpg',
                'price' => 3500,
                'detail' => 'おしゃれなショルダーバッグ',
                'condition_id' => 3,
            ],
            [
                'name' => 'タンブラー',
                'brand' => 'A',
                'img' => 'Tumbler+souvenir.jpg',
                'price' => 500,
                'detail' => '使いやすいタンブラー',
                'condition_id' => 4,
            ],
            [
                'name' => 'コーヒーミル',
                'brand' => 'A',
                'img' => 'Waitress+with+Coffee+Grinder.jpg',
                'price' => 4000,
                'detail' => '手動のコーヒーミル',
                'condition_id' => 1,
            ],
            [
                'name' => 'メイクセット',
                'brand' => 'A',
                'img' => 'MakeSet.jpg',
                'price' => 2500,
                'detail' => '便利なメイクアップセット',
                'condition_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            $localPath = public_path('img/' . $product['img']);
            $storagePath = 'img/' . $product['img'];
            Storage::disk('public')->put($storagePath, file_get_contents($localPath));

            $imageName = 'img/' . $product['img'];
            DB::table('products')->insert([
                'name' => $product['name'],
                'brand' => $product['brand'],
                'img' => $storagePath,
                'price' => $product['price'],
                'detail' => $product['detail'],
                'condition_id' => $product['condition_id'],
            ]);
        }
    }
}
