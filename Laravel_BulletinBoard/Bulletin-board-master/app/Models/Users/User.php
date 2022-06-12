<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Http\Controllers\User\UserController;
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
