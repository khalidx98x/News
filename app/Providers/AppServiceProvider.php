<?php

namespace App\Providers;

use App\Post;
use App\User;
use App\Comment;
use App\Setting;
use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $settings = Setting::all();
        foreach ($settings as $key => $setting) {
            if ($key === 0) {
                $system_name = $setting->value;
            } elseif ($key === 1) {
                $favicon = $setting->value;
            } elseif ($key === 2) {
                $front_logo = $setting->value;
            } elseif ($key === 3) {
                $admin_logo = $setting->value;
            }
        }

        $categories = Category::where('status', 1)->get();
        $authors = User::where('id', '!=', 1)->get();
        $top_viewed = Post::with(['user', 'comments'])->where('status', 1)->orderBy('view_count', 'DESC')->limit(2)->get();

        $most_commented = Post::withCount('comments')->where('status', 1)->orderBy('comments_count', 'DESC')->limit(5)->get();
        $comments = Comment::where('status', 1)->orderBy('id', 'DESC')->limit(4)->get();

        $shareData = array(
        'system_name' => $system_name,
        'favicon' => $favicon,
        'front_logo' => $front_logo,
        'admin_logo' => $admin_logo,
        'categories' => $categories,
        'authors' => $authors,
        'top_viewed' => $top_viewed,
        'most_commented' => $most_commented,
        'comments' => $comments,
       );
        view()->share('shareData', $shareData);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
