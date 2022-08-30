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
    // PostMainCategoryとのリレーション
    public function PostMainCategory()
    {
        return $this->hasMany('App\Models\Posts\PostMainCategory');
    }
      // PostSubCategoryとのリレーション
    public function PostSubCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }
     //投稿に対してのコメント
    public function PostComment()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }
    //閲覧者数取得用
    public function ActionLog()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    //ユーザーの投稿とidを繋ぐ処理
    public function UserPosts(Int $id)
    {
        $userPost_ids[] = $id;

        return $this->where('id', $userPost_ids);
    }

    // PostFavoriteとのリレーション
    public function PostFavorite()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    // PostCommentFavoriteとのリレーション
    public function PostCommentFavorite()
    {
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }


    //Viewで使う、いいねされているかを判定するメソッド。
    public function isFavoritedBy($user): bool {
        return PostFavorite::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }

    //Viewで使う、コメントにいいねされているかを判定するメソッド。
    public function isCommentFavoritedBy($user): bool {
        return PostCommentFavorite::where('user_id', $user->id)->where('post_comment_id', $this->id)->first() !==null;
    }


}
