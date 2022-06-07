<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

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
