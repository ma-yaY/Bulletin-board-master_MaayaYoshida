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

   //自分の投稿表示
   Route::post('/myPost','User\UserController@myPost');
   Route::get('/myPost','User\UserController@myPost');


   //自分がいいねした投稿表示
   Route::post('/myFavorite','User\UserController@myFavorite');
   Route::get('/myFavorite','User\UserController@myFavorite');

   //カテゴリーページ
   Route::get('/category', 'Auth\Posts\PostsController@Category');
   Route::post('category/create', 'Auth\Posts\PostsController@MainCreate');
   Route::post('category/createSub', 'Auth\Posts\PostsController@SubCreate');


   //メインカテゴリー削除
   Route::get('/category/{id}/MainDelete', 'Auth\Posts\PostsController@MainDelete');
   //サブカテゴリー削除
   Route::get('/category/{id}/SubDelete', 'Auth\Posts\PostsController@SubDelete');


   Route::get('/post', 'Auth\Posts\PostsController@SubSelect');
   Route::post('/post/create', 'Auth\Posts\PostsController@create');


   Route::get('detail/{id}', 'User\UserController@detail')->name('detail');

     //コメント投稿処理
  Route::post('/comment/create', 'Auth\Posts\PostCommentsController@comment');
  Route::get('/users/{id}/detail', 'Auth\Posts\PostCommentsController@CommentPosts');



  //投稿編集ー投稿詳細画面に戻る
  Route::get('/posts/{id}/edit', 'User\UserController@edit');
  Route::post('/posts/Edit{id}', 'User\UserController@updatePost');
  //投稿削除
  Route::get('/post/{id}/delete', 'Auth\Posts\PostsController@delete');

  //コメント編集ーコメント詳細画面に戻る
  Route::get('/posts/{id}/CommentEdit', 'Auth\Posts\PostCommentsController@CommentEdit');
  Route::post('/posts/Comment_edit{id}', 'Auth\Posts\PostCommentsController@updateComment');

  //コメント削除
  Route::get('/post/{id}/CommentDelete', 'Auth\Posts\PostCommentsController@CommentDelete');
  Route::post('/top', 'Auth\Posts\PostsController@index');


 //いいね機能
  Route::post('/Favorite', 'PostFavoriteController@Favorite')->name('Post.PostFavorite');

  //コメントいいね機能
 Route::post('/CommentFavorite', 'PostCommentFavoriteController@CommentFavorite')->name('PostComment.CommentPostFavorite');
 });




//登録
 Route::get('/added', 'Auth\Register\RegisterController@added');
 Route::post('/added', 'Auth\Register\RegisterController@added');


 //ログアウト用
Route::get('/logout', 'Auth\Login\LoginController@logout');
