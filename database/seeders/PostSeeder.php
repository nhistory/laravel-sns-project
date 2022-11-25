<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'First post',
            'contents' => 'This is first post',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'img_url' => 'https://cdn.inflearn.com/public/files/pages/61295e30-5b2b-4043-afd4-605bccda8873/%EA%B0%9C%EB%B0%9C%EC%9E%90%20%EB%B0%88.png'
        ]);
        DB::table('posts')->insert([
            'title' => 'Second post',
            'contents' => 'This is second post',
            'created_by' => 2,
            'created_at' => Carbon::now(),
            'img_url' => 'https://cdn.inflearn.com/public/files/pages/38a1b22f-0723-4788-b26e-9d7edb108c2f/%EB%AC%B8%EC%84%9C%EC%9D%BD%EA%B8%B0.jpg'
        ]);
        DB::table('posts')->insert([
            'title' => 'Third post',
            'contents' => 'This is third post',
            'created_by' => 3,
            'created_at' => Carbon::now(),
            'img_url' => 'https://cdn.inflearn.com/public/files/pages/38c3fb10-72a4-4ea5-8361-4ee6b682e188/SVG.jpg'
        ]);
    }
}
