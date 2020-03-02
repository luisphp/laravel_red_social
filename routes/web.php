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

use App\image;

Route::get('/', function () {
    /*
    $images = Image::All();
    foreach($images as $image){
        $i = 1;
        echo $image->image_path."<br>";
        echo $image->user->name."<br>";
        
        echo "Comentarios:";
        foreach($image->comments as $comment){
            echo $comment->content;
        }

        echo "<hr>";
        $i++;
    }
    die();
    */
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/config', 'UserController@config')->name('config');
Route::post('/user/edit', 'UserController@update')->name('update_user');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.image');

Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/store', 'ImageController@store')->name('image.store');
Route::get('/image/get/{filename?}', 'ImageController@getImage')->name('image.get');
Route::get('/image/show/{id}', 'ImageController@show')->name('image.show');
Route::post('/comment/store', 'CommentController@store')->name('comment.store');
Route::post('/comment/delete/{id}', 'CommentController@destroy')->name('comment.destroy');