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

 // Rutas de usuario
Route::get('/user/all/{search?}', 'UserController@index')->name('user.index');
Route::get('/user/config', 'UserController@config')->name('config');
Route::post('/user/edit', 'UserController@update')->name('update_user');
Route::get('/my_profile/{id}', 'UserController@profile')->name('myprofile');
Route::get('/user/avatar/{filename?}', 'UserController@getImage')->name('user.image');

//Rutas de imagenes
Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/store', 'ImageController@store')->name('image.store');
Route::get('/image/get/{filename?}', 'ImageController@getImage')->name('image.get');
Route::get('/image/show/{id}', 'ImageController@show')->name('image.show');
Route::get('/image/delete/{id}', 'ImageController@destroy')->name('image.delete');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

//Rutas de comentarios
Route::post('/comment/store', 'CommentController@store')->name('comment.store');
Route::get('/comment/delete/{id}', 'CommentController@destroy')->name('comment.destroy');

//Rutas de Likes
Route::get('/like/{id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{id}', 'LikeController@dislike')->name('dislike');
Route::get('/mis_likes', 'LikeController@mis_likes')->name('mislikes');
