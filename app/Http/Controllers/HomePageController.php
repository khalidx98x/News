<?php

namespace App\Http\Controllers;

use App\Post;

class HomePageController extends Controller
{
    public function index()
    {
        $recent_news = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $posts = Post::orderBy('id', 'desc')->paginate(8);
        $hot_news = Post::with('user')->where('hot_news', 1)->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('front.home', compact('hot_news', 'posts', 'recent_news'));
    }
}
