<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request\CreateRequest;
use Illuminate\Validation\Rule;

use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Users\User;
use App\Models\Posts\Post;


class UserController extends Controller
{


    public function search(Request $request){
        $user = \DB::table('users')->get();
        return view('/top',['user'=> $user]);

        $keyword = $request->input('keyword');
    }

        public function result(Request $request){
        $keyword = $request->input('keyword');
        $user= \DB::table('users')
            ->where('username','LIKE',"%{$keyword}%")->get();


            return view('/top',['user'=> $user]);
    }
        //掲示板詳細画面
        public function detail($id, Post $Post,PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory){

        $user = User::find($id);
        $userPost_ids = $Post->UserPosts($id)->get();
        $SubCategorys = Post::with(['user','postSubCategory'])->get();
        return view('auth.detail', [ 'userPost_ids'=> $userPost_ids, 'SubCategorys' => $SubCategorys]);
    }
        //投稿編集画面
        public function edit(Request $request, $id, Post $Post, PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory){
        $user = User::find($id);
        $userPost_ids = $Post->UserPosts($id)->get();
        $SubCategorys = Post::with(['user','postSubCategory'])->get();
        //dd($SubCategorys);
        //$categories = PostMainCategory::with('PostSubCategory')->get();
        return view('posts.edit',[ 'userPost_ids'=> $userPost_ids, 'SubCategorys' => $SubCategorys]);
         }
//         public function updateForm(Request $request,$id)
//    {
//        $up_post = $request->input('upPost');
//        \DB::table('posts')
//            ->where('id', $id)
//            ->update(
//                ['post' => $up_post]
//            );
//        return redirect('top');
//    }

//    public function delete($id)
//    {
//        \DB::table('posts')
//            ->where('id', $id)
//            ->delete();

//        return redirect('top');
//    }

}
