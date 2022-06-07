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
