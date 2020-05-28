<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\Post\StoreRequest;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    public function index()
    {
        if (Auth::user()->type === 1 || Auth::user()->hasRole('Editor')) {
            $posts = Post::with(['user'])->orderBy('id', 'DESC')->get();
        } else {
            $posts = Post::with(['user'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        }
        return parent::success($posts);
    }

    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $data = $request->except(['image']);
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->title);
        $post = Post::create($data);

        // if ($request->image) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $main_image = 'post_main_' . $post->id . '.' . $extension;
        //     $thumb_image = 'post_thumb_' . $post->id . '.' . $extension;
        //     $list_image = 'post_list_' . $post->id . '.' . $extension;

        //     Image::make($file)->resize(653, 569)->save(public_path('uploads\post/' . $main_image));
        //     Image::make($file)->resize(360, 309)->save(public_path('uploads\post/' . $thumb_image));
        //     Image::make($file)->resize(122, 122)->save(public_path('uploads\post/' . $list_image));
        // }

        // $post->update([
        //     'main_image' => $main_image,
        //     'thumb_image' => $thumb_image,
        //     'list_image' => $list_image
        // ]);

        return parent::success($post);
    }


    public function update(StoreRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->except(['image']);
        $data['slug'] = Str::slug($request->title);

        // if($request->image){
        //     Storage::disk('public_uploads')->delete('post/'.$post->main_image);
        //     Storage::disk('public_uploads')->delete('post/'.$post->thumb_image);
        //     Storage::disk('public_uploads')->delete('post/'.$post->list_image);

        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //    $data['main_image'] = 'post_main_'.$post->id.'.'.$extension;
        //     $data['thumb_image'] = 'post_thumb_'.$post->id.'.'.$extension;
        //     $data['list_image'] = 'post_list_'.$post->id.'.'.$extension;

        //     Image::make($file)->resize(653,569)->save(public_path('uploads\post/'. $data['main_image']));
        //     Image::make($file)->resize(360,309)->save(public_path('uploads\post/'. $data['thumb_image']));
        //     Image::make($file)->resize(122,122)->save(public_path('uploads\post/'. $data['list_image']));
        // }


        $post->update($data);


        return parent::success($post);
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('public_uploads')->delete('post/' . $post->main_image);
        Storage::disk('public_uploads')->delete('post/' . $post->thumb_image);
        Storage::disk('public_uploads')->delete('post/' . $post->list_image);
        $post->delete();
        return parent::success($post);
    }

    public function status($id)
    {
        $post = Post::findOrFail($id);
        $post->status == 1 ? $post->status = 0 : $post->status = 1;
        $post->save();
        return parent::success($post);
    }



    public function hot_news($id)
    {
        $post = Post::findOrFail($id);
        $post->hot_news == 1 ? $post->hot_news = 0 : $post->hot_news = 1;
        $post->save();
        return parent::success($post);
    }

    private function rules($method, $id = null)
    {
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ];

        // if ($method == 'post') {
        //     $rules += [
        //         'image' => 'required|image'

        //     ];
        // }


        return $rules;
    }
}
