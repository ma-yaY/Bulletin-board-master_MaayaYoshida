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

/*Route::get('/', function () {*/
    /*return view('welcome');
});*/

Auth::routes([
   'register' => false
]);

//ログアウト中のページ
Route::get('/login', 'Auth\Login\LoginController@login')->name('login');
Route::post('/login', 'Auth\Login\LoginController@login');

   //ログイン
 Route::get('/register', 'Auth\Register\RegisterController@register');
 Route::post('/register', 'Auth\Register\RegisterController@register');


 Route::group(['middleware' => 'auth'], function() {

   Route::get('/top', 'Auth\Posts\PostsController@index');

   Route::get('/category', 'Auth\Posts\PostsController@Category');
   Route::post('category/create', 'Auth\Posts\PostsController@MainCreate');
   Route::post('category/createSub', 'Auth\Posts\PostsController@SubCreate');
   Route::get('/category/{id}/SubDelete', 'Auth\Posts\PostsController@SubDelete');


   Route::get('/post', 'Auth\Posts\PostsController@SubSelect');
   Route::post('post/create', 'Auth\Posts\PostsController@create');

   Route::post('/result','User\UserController@result');
   Route::get('/result','User\UserController@result');

   Route::get('/users/{id}/detail', 'User\UserController@detail');

     //コメント投稿処理
  Route::post('/comment/create', 'Auth\Posts\PostCommentsController@comment');
  Route::get('/post/detail', 'Auth\Posts\PostsController@updatePost');


  Route::get('/posts/{id}/edit', 'User\UserController@edit');
  //Route::post('/post/detail{id}', 'Auth\Posts\PostsController@updatePost');

 //コメント取消処理
 // Route::get('/comments/{comment_id}', '\Admin\Post\CommentsController@destroy');


 });




//登録
 Route::get('/added', 'Auth\Register\RegisterController@added');
 Route::post('/added', 'Auth\Register\RegisterController@added');


 //ログアウト用
Route::get('/logout', 'Auth\Login\LoginController@logout');
