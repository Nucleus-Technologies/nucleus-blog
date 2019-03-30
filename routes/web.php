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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/category/{category}', 'PostsController@category')->name('category');

Route::get('/hash/{password}', function ($password) {
    echo \Illuminate\Support\Facades\Hash::make($password);
});

Route::get('/posts', 'PostsController@posts')->name('posts');

Route::get('/page', function () {
    return view('page');
});

Route::get('/posts/{slug}', 'PostsController@show')->name('posts.show');

Route::group(['prefix' => 'writer'], function () {
    
    Route::group(['middleware' => 'auth'], function () {
    
        Route::get('/', 'WritersController@dashboard')->name('writer.dashboard');
        
        Route::get('/profile', 'WritersController@profile')->name('writer.profile');
        
        Route::post('/profile', 'WritersController@update')->name('writer.update');
        
        Route::post('/profile/password', 'WritersController@password')->name('writer.password');
    
        Route::get('/logout', 'WritersController@logout')->name('logout');
    
        Route::resource('stories', 'StoriesController');
        
        Route::get('/stories/{story}/delete', 'StoriesController@destroy')->name('stories.delete');
        
        Route::get('/stories/{story}/publish', 'StoriesController@publish')->name('stories.publish');
        
        Route::get('/stories/images/upload', 'StoriesController@upload')->name('stories.upload');
        
        Route::get('/stories/{story}/like', 'StoriesController@like')->name('stories.like');
        
        Route::post('/stories/{story}/comment', 'CommentsController@comment')->name('comments.comment');
        
        Route::get('/stories/{story}/comments/{comment}/like', 'CommentsController@like')->name('comments.like');
        
    });
    
    Route::get('/login', 'WritersController@login')->name('login');
    
    Route::get('/register', 'WritersController@register')->name('register');
    
    Route::post('/login', 'WritersController@auth')->name('auth');
    
    Route::post('/register', 'WritersController@store')->name('writers.store');
    
});


