<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::create([
            "name"=> "Iphone",
            "desc"=> "Iphone 16",
            "price"=> 3000,
            "quantity"=> "5",
            "image"=> "products/pro1.jpg",

        ]);

        Product::create([
            "name"=> "watch 5",
            "desc"=> "watch 155dss 16",
            "price"=> 300,
            "quantity"=> "2",
            "image"=> "products/pro2.jpg",

        ]);

        Product::create([
            "name"=> "hp",
            "desc"=> "hp 16",
            "price"=> 200,
            "quantity"=> "4",
            "image"=> "products/pro3.jpg",

        ]);
    }
}
