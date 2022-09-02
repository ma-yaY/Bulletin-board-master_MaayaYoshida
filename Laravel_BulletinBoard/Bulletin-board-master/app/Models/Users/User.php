<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Models\ActionLogs\ActionLog;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Posts\PostCommentFavoritesController;
//use App\Models\Follow;


class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
// PostModelsとのリレーション
    public function post()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    //閲覧者数取得用
    public function ActionLog()
    {
        return $this->belongsTo('App\Models\ActionLogs\ActionLog');
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

    public function PostFavorite_s()
    {
        return $this->belongsToMany(self::class, 'PostFavorite', 'user_id', 'post_id');
    }

    public function CommentPostFavorite_s()
    {
        return $this->belongsToMany(self::class, 'PostCommentFavorite', 'user_id', 'post_comment_id');
    }



    // PostMain.SubCategoryとのリレーション
    public function PostMainCategory()
    {
        return $this->hasMany('App\Models\Posts\PostMainCategory');
    }

    public function PostSubCategory()
    {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }

  }
