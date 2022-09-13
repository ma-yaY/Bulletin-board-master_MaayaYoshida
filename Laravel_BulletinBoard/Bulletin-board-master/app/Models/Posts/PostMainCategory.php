<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';


    protected $fillable = [
        'main_category',
    ];

    //newMain_categoryモデルとのリレーション
    public function newMain_category()
    {
        return $this->hasMany('App\Models\Posts\newMain_category');
    }

    //Postモデルとのリレーション
    public function post()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }
    // PostSubCategoryとのリレーション
    public function PostSubCategory()
    {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }

    // カテゴリー選択
    public function MainCategoryId(Int $PostSubCategory_id)
    {
            return $this->post_main_categories()->attach($id);
    }




}
