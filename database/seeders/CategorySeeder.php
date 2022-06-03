<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ["name" => "Keyboards", "slug" => "keyboards"],
            ["name" => "Music", "slug" => "music"],
            ["name" => "Gaming", "slug" => "gaming"],
            ["name" => "Science", "slug" => "science"],
            ["name" => "Technology", "slug" => "tech"],
        ]);
    }
}
