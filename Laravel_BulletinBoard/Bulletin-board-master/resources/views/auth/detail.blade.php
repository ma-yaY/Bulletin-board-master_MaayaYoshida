@extends('layouts.login')

@section('title', '掲示板詳細画面')
@section('content')
    <!--<h1>掲示板詳細画面</h1>-->
    @foreach ($userPost_ids as $userPost_ids)
      <div class="d-post-area">
        <a class="d-user-name">{{$userPost_ids->user->username}}さん</a>
        <a class="d-day-time">{{$userPost_ids->created_at}}</a>

        <a class="d-View">{{$userPost_ids->ActionLog->count()}}View</a>

        <div class="d-post-title">
          <a class="user-title">{{$userPost_ids->title}}</a>
        </div>
        <a class="d-user-post">{{$userPost_ids->post}}</a>
        @if(Auth::user()->id == $userPost_ids->user_id)
        <p class="d-edit-btn"><a href="/posts/{{$userPost_ids->id}}/edit">編集</a></p>
        @endif
        <a class="d-Sub-category">{{$userPost_ids->postSubCategory->sub_category}}</a>
        <a class="ComenntCount">コメント数{{$userPost_ids->PostComment->count()}}</a>
          <div class="Favorite-heart">
              @auth
               @if (!$userPost_ids->isFavoritedBy(Auth::user()))
                  <span class="Favorite">
                    <i class="Favorite-toggle far fa-heart favorite" style="color:red"  data-post-id="{{$userPost_ids->id}}"></i>
                      <span class="Favorite-counter">{{$userPost_ids->PostFavorite->count()}}</span>
                  </span>
                  @else
                    <span class="Favorited">
                    <i class="Favorite-toggle fas fa-heart favorited" style="color:red" data-post-id="{{$userPost_ids->id}}"></i>
                      <span class="Favorite-counter">{{$userPost_ids->PostFavorite->count()}}</span>
                    </span>
                @endif
              @endauth
              @guest
                <span class="Favorite">
                  <i class="fa-solid fa-heart"></i>
                <span class="Favorite-counter">{{$userPost_ids->PostFavorite->count()}}</span>
                </span>
              @endguest
          </div>
        </div>
        <div class="commentArea" >
          <!--＄SubCategorysの中のリレーション先を指示$commentで特定-->
              @foreach ($SubCategorys->PostComment as $comment)
                <div class="up-commentArea">
                  <a class="comment-username">{{$comment->user->username}}さん</a>
                  <a class="comment-day-time">{{$comment->created_at}}</a>
                  @if(Auth::user()->id == $comment->user_id)
                  <p class="CommentEdit-btn"><a href="/posts/{{$comment->id}}/CommentEdit">編集</a></p>
                  @endif
                  <div class="comment">{{$comment->comment}}</div>
                  <div class="Comment-Favorite-heart">
                    @auth
                        @if (!$comment->isCommentFavoritedBy(Auth::user()))
                          <span class="Comment-Favorite">
                            <i class="CommentFavorite-toggle far fa-heart CommentFavorite" style="color:red"  data-comment-id="{{$comment->id}}"></i>
                              <span class="CommentFavorite-counter">{{$comment->PostCommentFavorite->count()}}</span>
                          </span>
                          @else
                            <span class="Comment-Favorited">
                            <i class="CommentFavorite-toggle fas fa-heart CommentFavorited" style="color:red" data-comment-id="{{$comment->id}}"></i>
                              <span class="CommentFavorite-counter">{{$comment->PostCommentFavorite->count()}}</span>
                            </span>
                        @endif
                      @endauth
                      @guest
                        <span class="Comment-Favorite">
                          <i class="fa-solid fa-heart"></i>
                        <span class="CommentFavorite-counter">{{$comment->PostFavorite->count()}}</span>
                        </span>
                      @endguest
                  </div>
                </div>
              @endforeach
         </div>
        <div class="comment-formArea">
          <p class="comment-form">コメント</p>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
          {!! Form::open(['url' => 'comment/create']) !!}
          {!! Form::hidden('id', $userPost_ids->id) !!}
            <div>{!! Form::textarea('comment', null,['class' => 'input', 'id' => 'comment', 'placeholder'=> 'こちらからコメントできます。', 'rows' => 4, 'cols'=> 20]) !!}</div>
            {!! Form::submit('コメント',['class' => 'comment-Form-button'])!!}
          {!! Form::close() !!}
          <!--<p class="top"><a href="/top">戻る</a></p>-->
        </div>
    @endforeach

@endsection
