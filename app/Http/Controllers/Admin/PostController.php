<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\Post\StoreRequest;

class PostController extends Controller
{
    //

    protected $page_name = 'Post Page';

    public function __construct()
    {
        $this->middleware('permission:index-post|all')->only('index');
        $this->middleware('permission:create-post|all')->only('create');
        $this->middleware('permission:update-post|all')->only('edit');
        $this->middleware('permission:delete-post|all')->only('destroy');
        $this->middleware('permission:status-post|all')->only('status');

    }

    public function index(){
        if (Auth::user()->type === 1 || Auth::user()->hasRole('Editor')) {
            $posts = Post::with(['user'])->orderBy('id','DESC')->get();
         }else{
            $posts = Post::with(['user'])->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
         }
         return view('admin.post.index')->with([
             'page_name'=>$this->page_name,
             'posts'=>$posts
         ]);
    }
    public function create(){
        $categories = Category::where('status','1')->get();

        return view('admin.post.create')->with([
            'page_name'=>$this->page_name,
            'categories'=>$categories
        ]);
    }


    public function edit($id){
        $post = Post::findOrFail($id);
        $categories = Category::where('status','1')->get();

        return view('admin.post.edit')->with([
            'page_name'=>$this->page_name,
            'post'=>$post,
            'categories'=>$categories
        ]);
    }


    public function update(StoreRequest $request , $id){
        $post = Post::findOrFail($id);
        $data = $request->except(['image']);
        $data['slug']=Str::slug($request->title);

        if($request->image){
            Storage::disk('public_uploads')->delete('post/'.$post->main_image);
            Storage::disk('public_uploads')->delete('post/'.$post->thumb_image);
            Storage::disk('public_uploads')->delete('post/'.$post->list_image);

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
           $data['main_image'] = 'post_main_'.$post->id.'.'.$extension;
            $data['thumb_image'] = 'post_thumb_'.$post->id.'.'.$extension;
            $data['list_image'] = 'post_list_'.$post->id.'.'.$extension;

            Image::make($file)->resize(653,569)->save(public_path('uploads\post/'. $data['main_image']));
            Image::make($file)->resize(360,309)->save(public_path('uploads\post/'. $data['thumb_image']));
            Image::make($file)->resize(122,122)->save(public_path('uploads\post/'. $data['list_image']));
        }


        $post->update($data);


        return redirect()->route('post.index')->with('success','The post has been updated successfully!!');


    }

    public function store(StoreRequest $request){

        $data = $request->except(['image']);
        $data['user_id']=auth()->user()->id;
        $data['slug']=Str::slug($request->title);
        $post = Post::create($data);

        if($request->image){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $main_image = 'post_main_'.$post->id.'.'.$extension;
            $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
            $list_image = 'post_list_'.$post->id.'.'.$extension;

            Image::make($file)->resize(653,569)->save(public_path('uploads\post/'.$main_image));
            Image::make($file)->resize(360,309)->save(public_path('uploads\post/'.$thumb_image));
            Image::make($file)->resize(122,122)->save(public_path('uploads\post/'.$list_image));
        }

        $post->update([
            'main_image'=>$main_image,
            'thumb_image'=>$thumb_image,
            'list_image'=>$list_image
        ]);

        return redirect()->route('post.index')->with('success','the post has been created successfully');

    }


    public function destroy($id){
        $post = Post::findOrFail($id);
        Storage::disk('public_uploads')->delete('post/'.$post->main_image);
        Storage::disk('public_uploads')->delete('post/'.$post->thumb_image);
        Storage::disk('public_uploads')->delete('post/'.$post->list_image);
        $post->delete();
        return redirect()->route('post.index')->with('success','the post has been deleted successfully');


    }

    public function status($id){
        $post = Post::findOrFail($id);
        $post->status ==1?$post->status =0 :$post->status =1;
        $post->save();
        return redirect()->route('post.index')->with('success','The post status has changed successfully !!');

    }



    public function hot_news($id){
        $post = Post::findOrFail($id);
        $post->hot_news ==1?$post->hot_news =0 :$post->hot_news =1;
        $post->save();
        return redirect()->route('post.index')->with('success','The post hot news has been changed successfully !!');

    }
}
