<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
use App\User;
use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->name;

    $image = Storage::disk('public_uploads')->get('others/post_image.jpg');

    $main_image = 'post_main_'.$title.'.jpg';
    $thumb_image = 'post_thumb_'.$title.'.jpg';
    $list_image = 'post_list_'.$title.'.jpg';

    Image::make($image)->resize(653, 569)->save(public_path('uploads\post/'.$main_image));
    Image::make($image)->resize(360, 309)->save(public_path('uploads\post/'.$thumb_image));
    Image::make($image)->resize(122, 122)->save(public_path('uploads\post/'.$list_image));

    return [
        'title' => $title,
        'short_description' => $faker->text,
        'description' => $faker->realText(),
        'slug' => Str::slug($title),
        'category_id' => Category::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'view_count' => $faker->randomNumber(),
        'hot_news' => $faker->randomElement(['0', '1']),
        'status' => $faker->randomElement(['0', '1']),
        'main_image' => $main_image,
        'thumb_image' => $thumb_image,
        'list_image' => $list_image,
    ];
});
