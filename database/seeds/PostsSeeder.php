<?php

use App\Posts;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = ['Водій', 'Менеджер', 'Перевізник'];

        foreach ($posts as $post) {

            Posts::firstOrCreate([
                'name' => $post,
            ]);
        }
    }
}
