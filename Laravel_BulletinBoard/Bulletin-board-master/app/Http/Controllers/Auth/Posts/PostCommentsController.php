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


    //詳細画面コメント追加
    public function comment(Request $request)
    {
        $auth = Auth::user();
        $post_id = Post::with(['user', 'PostComment'])->get();
        $comment = $request->input('comment');
        $delete_user_id = Auth::user()->id;
        $update_user_id = $delete_user_id;
        $event_at = Carbon::now();
        $validateData = $request -> validate([
            'comment' => ['required', 'max:2500', 'string', 'min:1'],
        ]);
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


         //コメント編集画面
        public function CommentEdit(Request $request, $id, Post $Post, PostComment $PostComment)
        {
            $user = User::find($id);
            $Comment_ids = $PostComment->UserComments($id)->get();
            $Comment = PostComment::with(['user','Post'])->find($id);
            //dd($Comment_ids);

        return view('posts.CommentEdit',['Comment_ids' => $Comment_ids, 'Comment' => $Comment]);


         }


         //コメント編集詳細画面に戻る
         public function updateComment(Request $request,$id, Post $Post, PostMainCategory $PostMainCategory, PostSubCategory $PostSubCategory,PostComment $PostComment)
    {
        $post_id = Post::with(['user', 'PostComment'])->get();
        $Comment = PostComment::with(['user','Post'])->find($id);
        $SubCategorys = Post::with(['user','postSubCategory','PostComment'])->find($id);
        $up_comment = $request->input('upComment');
        $delete_user_id = Auth::user()->id;
        $update_user_id = $delete_user_id;
        $event_at = Carbon::now();
        $validateData = $request -> validate([
            'upComment' => ['required', 'max:2500', 'string', 'min:1'],
        ]);
        \DB::table('post_comments')
            ->where('id', $id)
            ->update([
                'comment' => $up_comment,
                'delete_user_id' => $delete_user_id,
                'update_user_id' => $update_user_id,
                'event_at' => $event_at
            ]);
        return redirect()->route('detail', ['id'=>$id]);
    }

        public function CommentDelete( $id, Post $Post)
    {
        $timelines = Post::with(['user','postSubCategory'])->get();
        \DB::table('post_comments')
           ->where('id', $id)
           ->delete();

        return redirect('top');
    }

}
