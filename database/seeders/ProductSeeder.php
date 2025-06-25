<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Điện thoại iPhone 15 Pro mới nhất với chip A17 Pro',
                'price' => 29990000,
                'stock' => 50,
                'category_id' => 1,
                'slug' => 'iphone-15-pro',
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Điện thoại Samsung Galaxy S24 với camera AI',
                'price' => 24990000,
                'stock' => 30,
                'category_id' => 1,
                'slug' => 'samsung-galaxy-s24',
            ],
            [
                'name' => 'Áo thun nam',
                'description' => 'Áo thun nam chất liệu cotton 100%',
                'price' => 299000,
                'stock' => 100,
                'category_id' => 2,
                'slug' => 'ao-thun-nam',
            ],
            [
                'name' => 'Quần jean nữ',
                'description' => 'Quần jean nữ kiểu dáng hiện đại',
                'price' => 599000,
                'stock' => 80,
                'category_id' => 2,
                'slug' => 'quan-jean-nu',
            ],
            [
                'name' => 'Bàn làm việc',
                'description' => 'Bàn làm việc gỗ tự nhiên cao cấp',
                'price' => 2999000,
                'stock' => 20,
                'category_id' => 3,
                'slug' => 'ban-lam-viec',
            ],
            [
                'name' => 'Ghế văn phòng',
                'description' => 'Ghế văn phòng ergonomic thoải mái',
                'price' => 1999000,
                'stock' => 25,
                'category_id' => 3,
                'slug' => 'ghe-van-phong',
            ],
            [
                'name' => 'Sách Laravel Framework',
                'description' => 'Sách hướng dẫn Laravel Framework từ cơ bản đến nâng cao',
                'price' => 299000,
                'stock' => 200,
                'category_id' => 4,
                'slug' => 'sach-laravel-framework',
            ],
            [
                'name' => 'Sách PHP Programming',
                'description' => 'Sách lập trình PHP cho người mới bắt đầu',
                'price' => 199000,
                'stock' => 150,
                'category_id' => 4,
                'slug' => 'sach-php-programming',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
