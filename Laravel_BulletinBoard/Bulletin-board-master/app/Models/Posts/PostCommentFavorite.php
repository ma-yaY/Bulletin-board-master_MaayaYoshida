<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    //後でViewで使う、いいねされているかを判定するメソッド。
    public function Favorite($user): bool {
        return PostFavorite::where('user_id', $user->id)->where('review_id', $this->id)->first() !==null;
    }

}
