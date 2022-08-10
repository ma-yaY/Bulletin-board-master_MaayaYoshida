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

    public function index(Request $request)
{
    $Favorites = Post::withCount('post_favorites')->orderBy('id', 'desc')->paginate(10);
    $param = [
        'Favorites' => $Favorites,
    ];
    return view('top', $param);
}
    public function Favorite(Request $request)
{
    return $request->post_id;
}
}
