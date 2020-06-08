<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

class ListingPageController extends Controller
{
    public function listing($id)
    {
        $posts = Post::with(['comments', 'category', 'user'])->where('status', 1)->where('user_id', $id)->orderBy('id', 'DESC')->paginate(5);
        $page_name = $posts[0]->user->name;

        return view('front.listing', compact('posts', 'page_name'));
    }

    public function listing1($id)
    {
        $posts = Post::with(['comments', 'category', 'user'])->where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->paginate(5);
        $page_name = Category::where('id', $id)->pluck('name')->first();

        return view('front.listing', compact('posts', 'page_name'));
    }
}
