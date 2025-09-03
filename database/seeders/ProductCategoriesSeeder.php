<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = [
            ['code' => 'PC-01', 'name' => 'Graduation'],
            ['code' => 'PC-02', 'name' => 'Wedding or Prewedding'],
            ['code' => 'PC-03', 'name' => 'Group or Family'],
            ['code' => 'PC-04', 'name' => 'Food or Product'],
            ['code' => 'PC-05', 'name' => 'Martenity or New Born'],
            ['code' => 'PC-06', 'name' => 'Rental Studio'],
        ];
        
        foreach ($productCategories as $productCategory) {
            ProductCategory::firstOrCreate(['code' => $productCategory['code'], 'name' => $productCategory['name']]);
        }
    }
}
