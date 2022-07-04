<?php

namespace App\Http\Controllers\Auth\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostComment;
use Carbon\Carbon;


class PostCommentsController extends Controller
{

     //掲示板詳細画面コメント表示
        public function detail_Comment($id, Post $Post, PostComment $PostComment){
        dd($PostComment);
        $user = User::find($id);
        $userPost_ids = $Post->UserPosts($id)->get();
        $comment = $PostComment->get();
        return view('auth.detail', [ 'userPost_ids'=> $userPost_ids, 'SubCategorys' => $SubCategorys, 'comment' => $comment]);
    }
    //詳細画面コメント追加
    public function comment(Request $request)
    {

        $auth = Auth::user();
        $post_id = Post::with(['user', 'PostComment'])->get();
        $comment = $request->input('comment');
        $delete_user_id = Auth::user()->id;
        $update_user_id = $delete_user_id;
        $event_at = Carbon::now();
        PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->input('id'),
            'comment' => $comment,
            'delete_user_id' => $delete_user_id,
            'update_user_id' => $update_user_id,
            'event_at' => $event_at
        ]);


       return back();
    }




}
