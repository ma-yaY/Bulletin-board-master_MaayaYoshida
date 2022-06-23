<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\PostComment;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\Posts\PostCommentsController;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];
      // UserModelsとのリレーション
        public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

        // PostSubCategoryとのリレーション
    public function PostSubCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }

    public function PostComment()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }


   //掲示板投稿一覧の処理
    public function topTimeLines(Int $user_id)
    {
        $post_ids[] = $user_id;

        return $this->whereIn('user_id', $post_ids)->orderBy('created_at', 'DESC')->paginate();
    }
    //ユーザーの投稿とidを繋ぐ処理
    public function UserPosts(Int $id)
    {
        $userPost_ids[] = $id;

        return $this->where('id', $userPost_ids);
    }







}
