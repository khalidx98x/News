<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ListingPageController extends Controller
{
    public function index(){
    	return view('front.listing');
    }

  public function listing($id){
  $posts = Post::with(['comments','category','user'])->where('status',1)->where('user_id',$id)->orderBy('id','DESC')->paginate(5);
  return view('front.listing',compact('posts'));

  }


    public function listing1($id){
  $posts = Post::with(['comments','category','user'])->where('status',1)->where('category_id',$id)->orderBy('id','DESC')->paginate(5);
  return view('front.listing',compact('posts'));

  }

}
