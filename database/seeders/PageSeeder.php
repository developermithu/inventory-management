<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([
            'name' => 'About',
            'slug' => 'about',
            'excerpt' => 'This is about page',
            'body' => 'This is about page',
            'meta_description' => 'about page',
            'meta_keywords' => 'about, about me, about us',
            'status' => true
        ]);
    }
}
