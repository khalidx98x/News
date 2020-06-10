<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $posts = factory(App\Post::class, 40)->create();
    }
}
