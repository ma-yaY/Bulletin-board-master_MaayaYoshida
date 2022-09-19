<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Post;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostComment;
use App\Models\Users\User;


class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];


    // UserModelsとのリレーション
        public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function post()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }


     // PostMainCategoryとのリレーション
     public function PostMainCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostMainCategory');
    }

    //ユーザーの投稿とサブカテゴリーを繋ぐ処理
    public function categoriesIds(Int $id)
  {

    $category_id[] = $id;
      return $this->where('category_id', $id)->get();
  }




}
