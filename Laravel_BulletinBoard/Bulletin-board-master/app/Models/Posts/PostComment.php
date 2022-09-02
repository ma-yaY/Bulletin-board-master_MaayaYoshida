<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Posts\PostFavorite;
use App\Models\ActionLogs\ActionLog;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\Posts\PostCommentsController;
use App\Http\Controllers\Auth\Posts\PostCommentFavoritesController;

class PostComment extends Model
{
    protected $table = 'post_comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

          // UserModelsとのリレーション
        public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

        // Postとのリレーション
    public function Post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }

    // PostSubCategoryとのリレーション
    public function PostSubCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }


    public function UserComments(Int $id)
    {
    $Comment_ids[] = $id;

    return $this->where('id', $Comment_ids);
    }

    // PostCommentFavoriteとのリレーション
    public function PostCommentFavorite()
    {
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }

    //Viewで使う、コメントにいいねされているかを判定するメソッド。
    public function isCommentFavoritedBy($user): bool {
        return PostCommentFavorite::where('user_id', $user->id)->where('post_comment_id', $this->id)->first() !==null;
    }
}
