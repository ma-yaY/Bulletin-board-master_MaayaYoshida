<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request\CreateRequest;
use Illuminate\Validation\Rule;

use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\ActionLogs\ActionLog;
use Carbon\Carbon;


class UserController extends Controller
{
    //自分の投稿表示
    public function myPost( Post $Post, PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory){
        $user = auth()->user();
        $timelines = Post::with(['user','postSubCategory'])->get() //$userによる投稿を取得
            ->where('user_id', $user->id);
            $categories = PostMainCategory::with('PostSubCategory')->get();

        return view('top', ['timelines' => $timelines, 'categories' => $categories]);
    }



    //自分がいいねした投稿表示
    public function myFavorite( Post $Post,PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory, PostFavorite $PostFavorite){
        $user = auth()->user();
        $timelines = Post::whereHas('PostFavorite', function ($q){
        //使いたいテーブルとその他テーブルを使いたい時whereHas
        //テーブル一個だけならwhereでOK
            $q->where('user_id',Auth::user()->id);
            //どのカラムを使えば良いのかテーブルに共通するカラムどれか
        })->get();
        //PostFavoriteテーブルの条件（user_idがログインユーザーのもの）を使用してユーザーを検索する
        $categories = PostMainCategory::with('PostSubCategory')->get();

        return view('top', ['timelines' => $timelines, 'categories' => $categories]);
    }




        //掲示板詳細画面
        public function detail($id, Post $Post,PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory,PostComment $PostComment){
        $user = User::find($id);
        $userPost_ids = $Post->UserPosts($id)->get();
        //$Comment_ids = $PostComment->UserComments($id)->get();
        //$users = Post::with(['user','ActionLog'])->find($id);

        $SubCategorys = Post::with(['user','postSubCategory','PostComment','ActionLog'])->find($id);
        $event_at = Carbon::now();
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'event_at' => $event_at
        ]);
        ddd($user);
        return view('auth.detail', [ 'userPost_ids'=> $userPost_ids, 'SubCategorys' => $SubCategorys, ]);
    }

        //投稿編集画面
        public function edit(Request $request, $id, Post $Post, PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory){
        $user = User::find($id);
        $userPost_ids = $Post->UserPosts($id)->get();
        $SubCategorys = Post::with(['user','postSubCategory'])->get();


        return view('posts.edit',[ 'userPost_ids'=> $userPost_ids, 'SubCategorys' => $SubCategorys]);
         }


        //投稿編集詳細画面に戻る
        public function updatePost(Request $request,$id, Post $Post)
    {
        $userPost_ids = $Post->UserPosts($id)->get();
        $SubCategorys = Post::with(['user','PostSubCategory','PostComment'])->find($id);
        $up_title = $request->input('upTitle');
        $up_post = $request->input('upPost');
        $delete_user_id = Auth::user()->id;
        $update_user_id = $delete_user_id;
        $event_at = Carbon::now();
        $validateData = $request -> validate([
            //'' => ['required', 'not_in'],
            'upTitle' => ['required', 'max:100', 'string', 'min:1'],
            'upPost' => ['required', 'max:5000', 'string', 'min:1'],
        ]);
        \DB::table('posts')
            ->where('id', $id)
            ->update([
                'post' => $up_post,
                'title' => $up_title,
                'delete_user_id' => $delete_user_id,
                'update_user_id' => $update_user_id,
                'event_at' => $event_at

            ]);

        return view('auth.detail',[ 'userPost_ids'=> $userPost_ids,  'SubCategorys' => $SubCategorys]);
    }






}
