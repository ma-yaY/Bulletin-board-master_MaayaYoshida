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


         //検索機能s
   Route::post('/result','Auth\Posts\PostsController@search');
   Route::get('/result','Auth\Posts\PostsController@search');


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
  Route::get('/users/{id}/detail', 'Auth\Posts\PostCommentsController@CommentPosts');
  Route::get('/users/{id}/detail', 'User\UserController@detail');


  //投稿編集ー投稿詳細画面に戻る
  Route::get('/posts/{id}/edit', 'User\UserController@edit');
  Route::post('/posts/Edit{id}', 'User\UserController@updatePost');

  Route::get('/post/{id}/delete', 'Auth\Posts\PostsController@delete');

  //コメント編集ーコメント詳細画面に戻る
  Route::get('/posts/{id}/CommentEdit', 'Auth\Posts\PostCommentsController@CommentEdit');
  Route::post('/posts/Comment_edit{id}', 'Auth\Posts\PostCommentsController@updateComment');
  Route::get('/users/{id}/detail', 'User\UserController@detail');


  Route::get('/post/{id}/CommentDelete', 'Auth\Posts\PostCommentsController@CommentDelete');

 //いいね機能
  Route::get('/reply/like/{id}', 'RepliesController@like')->name('reply.like');
  Route::get('/reply/unlike/{id}', 'RepliesController@unlike')->name('reply.unlike');





 });




//登録
 Route::get('/added', 'Auth\Register\RegisterController@added');
 Route::post('/added', 'Auth\Register\RegisterController@added');


 //ログアウト用
Route::get('/logout', 'Auth\Login\LoginController@logout');
