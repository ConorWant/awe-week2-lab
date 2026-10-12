<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name'=>'The Jam', 'title'=>'Modern World', 'price'=>399],
            ['name'=>'Amy Winehouse', 'title'=>'Back to Black', 'price'=>299]
        ];

        foreach($products as $product){
            Product::create([
                'name'=>$product['name'],
                'title'=>$product['title'],
                'price'=>$product['price'],
            ]);
        }
    }
}
