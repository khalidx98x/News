<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//routes for registering users
Route::post('register', 'API\AuthController@store')->name('user.store');


Route::group(['middleware' => 'auth:api'], function () {

    //author
    Route::get('author', ['as' => 'authors.index', 'uses' => 'API\AuthorController@index']);
    Route::post('author', ['as' => 'authors.store', 'uses' => 'API\AuthorController@store']);
    Route::put('author/{id}', ['as' => 'authors.update', 'uses' => 'API\AuthorController@update']);
    Route::delete('author/{id}', ['as' => 'authors.delete', 'uses' => 'API\AuthorController@destroy']);


    //categories
    Route::get('categories', ['as' => 'categories.index', 'uses' => 'API\CategoriesController@index']);
    Route::post('categories', ['as' => 'categories.store', 'uses' => 'API\CategoriesController@store']);
    Route::put('categories/{id}', ['as' => 'categories.update', 'uses' => 'API\CategoriesController@update']);
    Route::delete('categories/{id}', ['as' => 'categories.delete', 'uses' => 'API\CategoriesController@destroy']);
    Route::get('category/{id}/status', 'API\CategoriesController@status')->name('category.status');


    //posts
    Route::get('posts', ['as' => 'posts.index', 'uses' => 'API\PostsController@index']);
    Route::post('posts', ['as' => 'posts.store', 'uses' => 'API\PostsController@store']);
    Route::put('posts/{id}', ['as' => 'posts.update', 'uses' => 'API\PostsController@update']);
    Route::delete('posts/{id}', ['as' => 'posts.delete', 'uses' => 'API\PostsController@destroy']);
    Route::get('post/{id}/status', 'API\PostsController@status')->name('post.status');
    Route::get('post/{id}/hot', 'API\PostsController@hot_news')->name('post.hot');



    //permission routes
    Route::group(['prefix' => 'permission'], function () {
        Route::get('', 'API\PermissionController@index')->name('permission.index');
        Route::post('store', 'API\PermissionController@store')->name('permission.store');
        Route::patch('edit/{id}', 'API\PermissionController@update')->name('permission.update');
        Route::delete('{id}', 'API\PermissionController@destroy')->name('permission.destroy');
    });
    
    //roles routes
    Route::get('role', ['as' => 'roles.index', 'uses' => 'API\RoleController@index']);
    Route::post('role', ['as' => 'roles.store', 'uses' => 'API\RoleController@store']);
    Route::put('role/{id}', ['as' => 'roles.update', 'uses' => 'API\RoleController@update']);
    Route::delete('role/{id}', ['as' => 'roles.delete', 'uses' => 'API\RoleController@destroy']);

});
