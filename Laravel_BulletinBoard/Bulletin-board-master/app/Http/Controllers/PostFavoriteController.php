<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Posts\PostFavorite;
use App\Models\Users\PostCommentFavorite;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use Carbon\Carbon;


class PostFavoriteController extends Controller
{


    public function Favorite(Request $request)
{
    //return $request->post_id;
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post_id = $request->post_id; //2.投稿idの取得
    $already_Favorited = PostFavorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    //このユーザーがこの投稿にまだいいねしてなかったら
    if (!$already_Favorite) {
        $Favorite = new PostFavorite; //4.PostFevoriteクラスのインスタンスを作成
        $Favorite->$post_id = $post_id; //PostFevoriteインスタンスにpost__id,user_idをセット
        $Favorite->user_id = $user_id;
        $Favorite->save();
    } else { //このユーザーがこの投稿に既にいいねしてたらdelete
        PostFavorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $review_PostFavorite_count = Post::withCount('PostFavorite')->findOrFail($post_id)->count;
    $param = [
        'review_PostFavorite_count' => $review_PostFavorite_count,
    ];

    return response()->json($param); //6.JSONデータをjQueryに返す
}

}
