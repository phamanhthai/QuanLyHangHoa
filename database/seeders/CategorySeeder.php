<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Điện tử',
                'description' => 'Các sản phẩm điện tử và công nghệ',
                'slug' => 'dien-tu',
            ],
            [
                'name' => 'Thời trang',
                'description' => 'Quần áo và phụ kiện thời trang',
                'slug' => 'thoi-trang',
            ],
            [
                'name' => 'Nhà cửa',
                'description' => 'Đồ dùng gia đình và nội thất',
                'slug' => 'nha-cua',
            ],
            [
                'name' => 'Sách',
                'description' => 'Sách và tài liệu học tập',
                'slug' => 'sach',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
