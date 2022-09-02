<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request\CreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;


class PostCommentFavoritesController extends Controller
{

  public function CommentFavorite(Request $request)
{

    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $comment_id = $request->comment_id; //2.投稿idの取得
    $already_CommentFavorited = PostCommentFavorite::where('user_id', $user_id)->where('post_comment_id', $comment_id)->first(); //3.
    //このユーザーがこの投稿にまだいいねしてなかったら
    if (!$already_CommentFavorited) {
        $CommentFavorite = new PostCommentFavorite; //4.CommentPostFevoriteクラスのインスタンスを作成
        $CommentFavorite->post_comment_id = $comment_id; //CommentFevoriteインスタンスにpost_comment_id,user_idをセット
        $CommentFavorite->user_id = $user_id;
        $CommentFavorite->save();
    } else { //このユーザーがこの投稿に既にいいねしてたらdelete
        PostCommentFavorite::where('post_comment_id', $comment_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $review_CommentFavorite_count = PostCommentFavorite::where('post_comment_id', $comment_id)->count();

    $param = [
        'review_CommentFavorite_count' => $review_CommentFavorite_count,
    ];

    return response()->json($param); //6.JSONデータをjQueryに返す
}

}
