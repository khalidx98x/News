<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $posts = factory(App\Comment::class, 50)->create();
    }
}
