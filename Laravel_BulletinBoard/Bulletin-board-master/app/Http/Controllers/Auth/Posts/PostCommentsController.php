<?php

namespace App\Http\Controllers\Auth\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    public function comment(Request $request)
    {
        $auth = Auth::user();
        $user = auth()->user();
        $comment =  $request->input('comment');
        //postのidを引っ張る指示
        //デリートのid


        //$comment = new Comment();
       //$post_id = Auth::user()->id;
        \DB::table('post_comments')->insert([
            'user_id' => $user_id,
            'post_id' =>
            'comment' => $comment,


        ]);

       return redirect('/detail');
    }
}
