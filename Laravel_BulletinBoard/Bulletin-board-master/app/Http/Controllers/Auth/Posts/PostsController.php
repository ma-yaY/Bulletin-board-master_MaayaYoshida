<?php

namespace App\Http\Controllers\Auth\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use Carbon\Carbon;

class PostsController extends Controller
{
    //topの投稿表示
    public function index( Post $Post, PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory, ActionLog $ActionLog)
    {

        $auth = Auth::user();
        $timelines = Post::with(['user','postSubCategory','ActionLog','PostComment'])->get();
        $categories = PostMainCategory::with('PostSubCategory')->get();

        return view('/top',['timelines' => $timelines, 'categories' => $categories]);
    }


    //検索機能
        public function search(Request $request){
            $keyword = $request->input('keyword');
            $timelines= Post::with(['user','postSubCategory'])
            ->where('title','LIKE',"%{$keyword}%")//曖昧検索
            ->orWhereHas('postSubCategory',function($query) use($keyword){  //サブカテゴリーあったら完全一致検索
                $query->Where('title','=',$keyword);})
                ->orWhere('post', 'LIKE', "%{$keyword}%") //投稿のあいまい検索
            ->get();
            $categories = PostMainCategory::with('PostSubCategory')->get();

            return view('top',['timelines' => $timelines,'categories' => $categories]);
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
        $validateData = $request -> validate([
            'newMain_category' => ['required', 'max:100', 'string', 'min:1', 'unique:Post_Main_Category'],
        ]);

        \DB::table('post_main_categories')->insert([
            'main_category' => $main_category
        ]);

        return redirect('/category');
    }

    //メインとサブカテゴリー登録
    public function SubCreate(Request $request){
        $post_main_category_id = $request->input('main_category');
        $Sub_category = $request->input('sub_category');
        $validateData = $request -> validate([
            'sub_category' => ['required', 'max:100', 'string', 'min:1', 'unique:post_sub_categories'],
        ]);
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
        $validateData = $request -> validate([
            'Sub_category' => ['required', 'present'],
            'title' => ['required', 'max:255', 'string', 'min:1'],
            'newPost' => ['required', 'max:255', 'string', 'min:1', 'max:5000'],
        ]);
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


    //メインカテゴリー削除
       public function MainDelete($id)
    {
        \DB::table('post_main_categories')
            ->where('id', $id)
            ->delete();

        return redirect('category');
    }

      //サブカテゴリー削除
       public function SubDelete($id)
    {
        \DB::table('post_sub_categories')
            ->where('id', $id)
            ->delete();

        return redirect('category');
    }

       //投稿削除
        public function delete($id, PostSubCategory $PostSubCategory)
    {
        $categories = PostMainCategory::with('PostSubCategory')->get();
       $timelines = Post::with(['user','postSubCategory','ActionLog','PostComment'])->get();
        \DB::table('posts')
           ->where('id', $id)
           ->delete();

        return view('top',['timelines' => $timelines,'categories' => $categories,]);

    }







}
