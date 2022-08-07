<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Users\PostCommentFavorite;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use Carbon\Carbon;


class PostFavoriteController extends Controller
{

    //public function index(Request $request)
//{
    //$reviews = Review::withCount('likes')->orderBy('id', 'desc')->paginate(10);
    //$param = [
    //    'reviews' => $reviews,
    //];
    //return view('reviews.index', $param);
//}
    public function Favorite(Request $request)
{
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post__id = $request->post__id; //2.投稿idの取得
    $already_Favorite = PostFavorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    if (!$already_Favorite) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $Favorite = new PostFavorite; //4.PostFevoriteクラスのインスタンスを作成
        $Favorite->$post__id = $post__id; //PostFevoriteインスタンスにpost__id,user_idをセット
        $Favorite->user_id = $user_id;
        $Favorite->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        PostFavorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $review_likes_count = PostFavorite::withCount('Favorite')->findOrFail($post__id)->likes_count;
    $param = [
        'review_PostFavorite_count' => $review_PostFavorite_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}
}
