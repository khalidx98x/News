<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    public function index($slug)
    {
        $post = Post::with(['user', 'category', 'comments'])->where('status', 1)->withCount(['comments' => function ($q) {
            return $q->where('status', 1);
        }])->where('slug', $slug)->first();
        $post->view_count = $post->view_count + 1;

        $related_news = Post::with(['user', 'category'])->where('status', 1)->
  where('id', '!=', $post->id)->where('category_id', $post->category_id)->orderBy('id', 'DESC')->limit(2)->get();

        $post->save();

        return view('front.single', compact('post', 'related_news'));
    }

    public function comment(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
    ]);
        $data = $request->all();
        $data['status'] = 1;
        Comment::create($data);

        return redirect()->route('details', $post->slug)->with('success', 'The comment has been created successfully !!');
    }
}
