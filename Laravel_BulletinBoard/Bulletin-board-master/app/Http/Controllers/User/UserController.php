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

        return view('top', ['timelines' => $timelines]);
    }


        //掲示板詳細画面
        public function detail($id, Post $Post,PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory,PostComment $PostComment){
        $userPost_ids = $Post->UserPosts($id)->get();
        $SubCategorys = Post::with(['user','postSubCategory','PostComment','ActionLog'])->find($id);//findで取り出すものを特定する。getは全部持ってきちゃう

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'event_at' => Carbon::now()
        ]);
        return view('auth.detail', [ 'userPost_ids'=> $userPost_ids, 'SubCategorys' => $SubCategorys,]);
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
        $up_post = $request->input('upPost');
        $up_title = $request->input('upTitle');
        $delete_user_id = Auth::user()->id;
        $update_user_id = $delete_user_id;
        $event_at = Carbon::now();
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
