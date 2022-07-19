<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

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
}
