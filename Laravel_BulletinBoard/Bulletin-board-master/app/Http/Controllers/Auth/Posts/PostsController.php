<?php

namespace App\Http\Controllers\Auth\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use Carbon\Carbon;

class PostsController extends Controller
{
    //topの投稿表示
    public function index( Post $Post, PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory)
    {
        $auth = Auth::user();
        $user = auth()->user();
        $timelines = Post::with(['user','postSubCategory'])->get();
        return view('/top', ['timelines' => $timelines]);
    }

    //検索機能
        public function search(Request $request){
            $keyword = $request->input('keyword');
            $timelines= Post::with(['user','postSubCategory'])
            ->where('title','LIKE',"%{$keyword}%")->get();

            return view('top',['timelines' => $timelines]);
    }



    //ALLカテゴリ表示
    public function Category(PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory)
    {
        $auth = Auth::user();
        $user = auth()->user();

        $categories = PostMainCategory::with('PostSubCategory')->get();
        return view('category',['categories' => $categories, ]);
    }

     //カテゴリー登録
    public function MainCreate(Request $request){
        $main_category = $request->input('newMain_category');
        \DB::table('post_main_categories')->insert([
            'main_category' => $main_category
        ]);
        return redirect('/category');
    }

    //メインとサブカテゴリー登録
    public function SubCreate(Request $request){
        $Sub_category = $request->input('sub_category');
        $post_main_category_id = $request->input('main_category');
        \DB::table('post_sub_categories')->insert([
            'post_main_category_id' => $post_main_category_id,
            'sub_category' => $Sub_category
        ]);
        return redirect('/category');
    }


       //サブカテゴリーを選択
        public function SubSelect(PostSubCategory $PostSubCategory) {
        $Sub_categories = PostSubCategory::all();
        return view('posts.post',['Sub_categories' => $Sub_categories, ]);
    }

    //上でサブカテゴリーを選んだ
    //新規投稿
    public function create(Request $request, PostSubCategory $PostSubCategory)
    {
        $auth = Auth::user();
        $user = auth()->user();
        $post_sub_category_id = $request->input('Sub_category');
        $post = $request->input('newPost');
        $title = $request->input('title');
        $event_at = Carbon::now();
        //$event_at = time();
        //echo date( DATE_ATOM ) ;
        \DB::table('posts')->insert([
            'user_id' => Auth::user()->id,
            'post_sub_category_id' => $post_sub_category_id,
            'post' => $post,
            'title' => $title,
            'event_at' => $event_at
        ]);

        return redirect('top');
    }


      //サブカテゴリー削除
       public function SubDelete(id $id, PostSubCategory $PostSubCategory)
    {
        \DB::table('post_sub_categories')
            ->where('id', $id)
            ->delete();

        return redirect('category');
    }







}
