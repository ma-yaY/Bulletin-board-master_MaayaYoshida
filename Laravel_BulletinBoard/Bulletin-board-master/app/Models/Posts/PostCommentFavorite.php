<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\PostComment;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\Post;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\Posts\PostCommentsController;
use App\Http\Controllers\Auth\Posts\PostCommentFavoritesController;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
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

    //コメント用いいね
    public function CommentFavoriteIds(Int $user_id)
  {
      return $this->where('user_id', $post_comment_id)->get();
  }




}
