<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
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

    public function ActionLog()
    {
        return $this->belongsTo('App\Models\ActionLogs\ActionLog');
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

    public function PostFavorite()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }
    //Viewで使う、いいねされているかを判定するメソッド。
    public function isFavoritedBy($user): bool {
        return PostFavorite::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }






}
