<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Post;
use App\Category;

// Route::get('/', function () {
//     return view('welcome');
//     // return view('test');
// });

// Route::get('/master',function(){
//     return view('front.layout.master');
// });

// Route::get('/back',function(){
//     return view('admin.layout.master');
// });

Route::get('/', 'HomePageController@index')->name('homepage');
Route::get('/category/{id}', 'ListingPageController@listing1');
Route::get('/author/{id}', 'ListingPageController@listing');
// Route::get('/listing', 'ListingPageController@index');
Route::get('/details/{slug}', 'SinglePageController@index')->name('details');
Route::post('/comments', 'SinglePageController@comment')->name('postcomment.store');

//Backend control panel
Route::group(['prefix' => 'back', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    //dashboard homepage
    Route::get('', 'DashboardController@index')->name('back.index');

    //categories routes

    //permission routes
    Route::group(['prefix' => 'permission'], function () {
        Route::get('', 'PermissionController@index')->name('permission.index');
        Route::get('create', 'PermissionController@create')->name('permission.create');
        Route::post('create', 'PermissionController@store')->name('permission.store');

        Route::get('edit/{id}', 'PermissionController@edit')->name('permission.edit');
        Route::patch('edit/{id}', 'PermissionController@update')->name('permission.update');
        Route::delete('{id}', 'PermissionController@destroy')->name('permission.destroy');
    });
    Route::resource('role', 'RoleController')->except(['show']);
    Route::resource('author', 'AuthorController')->except(['show']);

    Route::resource('category', 'CategoriesController')->except(['show']);
    Route::get('category/{id}/status', 'CategoriesController@status')->name('category.status');

    Route::resource('post', 'PostController')->except(['show']);
    Route::get('post/{id}/status', 'PostController@status')->name('post.status');
    Route::get('post/{id}/hot', 'PostController@hot_news')->name('post.hot');

    Route::group(['prefix' => 'comment'], function () {
        Route::get('{id}', 'CommentController@index')->name('comment.index');
        Route::get('replay/{id}', 'CommentController@replay')->name('comment.replay');
        Route::post('replay/{id}', 'CommentController@store')->name('comment.store');
        Route::get('{id}/status', 'CommentController@status')->name('comment.status');
    });

    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::patch('settings', 'SettingsController@update')->name('settings.update');
});

Auth::routes();

// Route::get('test', function () {
//     $posts = App\Post::with(['comments', 'category', 'user'])->where('status', 1)
//     ->where('user_id', 1)->orderBy('id', 'DESC')->get();
//     foreach ($posts as $index => $item) {
//         // if ($index == 0) {
//         //     continue;
//         // }
//         dd($item);
//     }
// });
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('test', function () {
    $posts = Post::all();

    for ($i = 1; $i < count($posts); ++$i) {
        dd($posts[$i]);
    }
});
