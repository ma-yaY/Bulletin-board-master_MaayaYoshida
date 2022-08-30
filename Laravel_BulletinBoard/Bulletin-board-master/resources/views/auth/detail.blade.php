@extends('layouts.login')

@section('title', '掲示板詳細画面')
@section('content')
    <!--<h1>掲示板詳細画面</h1>-->
    @foreach ($userPost_ids as $userPost_ids)
      <div class="post-area">
        <a class="user-name">{{$userPost_ids->user->username}}</a>
        <a class="day-time">{{$userPost_ids->created_at}}</a>
        <a class="View">{{$userPost_ids->ActionLog->count()}}View</a>
        <div class="post-title">
          <a class="user-title">{{$userPost_ids->title}}</a>
        </div>
        <a class="user-post">{{$userPost_ids->post}}</a>

        <a class="ComenntCount">{{$userPost_ids->PostComment->count()}}コメント数</a>
        <p class="edit-btn"><a href="/posts/{{$userPost_ids->id}}/edit">編集</a></p>
      </div>
              @auth
               @if (!$userPost_ids->isFavoritedBy(Auth::user()))
                  <span class="Favorite">
                    <i class="Favorite-toggle far fa-heart favorite" style="color:red"  data-Post-id="{{$userPost_ids->id}}"></i>
                      <span class="Favorite-counter">{{$userPost_ids->PostFavorite->count()}}</span>
                  </span>
                  @else
                    <span class="Favorited">
                    <i class="Favorite-toggle fas fa-heart favorited" style="color:red" data-Post-id="{{$userPost_ids->id}}"></i>
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

        <div class="commentArea" >
          <!--＄SubCategorysの中のリレーション先を指示$commentで特定-->
          @foreach ($SubCategorys->PostComment as $comment)
          <a class="comment">{{$comment->comment}}</a>
          {{$comment->user->username}}
          <p class="CommentEdit-btn"><a href="/posts/{{$comment->id}}/CommentEdit">編集</a></p>
          @auth
               @if (!$SubCategorys->isCommentFavoritedBy(Auth::user()))
                  <span class="Coment-Favorite">
                    <i class="CommentFavorite-toggle far fa-heart CommentFavorite" style="color:red"  data-Comment-id="{{$SubCategorys->id}}"></i>
                      <span class="CommentFavorite-counter">{{$SubCategorys->PostCommentFavorite->count()}}</span>
                  </span>
                  @else
                    <span class="Comment-Favorited">
                    <i class="Favorite-toggle fas fa-heart CommentFavorited" style="color:red" data-Comment-id="{{$SubCategorys->id}}"></i>
                      <span class="CommentFavorite-counter">{{$SubCategorys->PostCommentFavorite->count()}}</span>
                    </span>
                @endif
              @endauth
              @guest
                <span class="Coment-Favorite">
                  <i class="fa-solid fa-heart"></i>
                <span class="ComentFavorite-counter">{{$SubCategorys->PostFavorite->count()}}</span>
                </span>
              @endguest
          @endforeach

          <div class="form-group">
              <p class="comment-form">コメント</p>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
              {!! Form::open(['url' => 'comment/create']) !!}
              {!! Form::hidden('id', $userPost_ids->id) !!}
                <div>{!! Form::textarea('comment', null,['class' => 'input', 'id' => 'comment', 'placeholder'=> 'こちらからコメントできます。', 'rows' => 4, 'cols'=> 20]) !!}</div>
                {!! Form::submit('コメント',['class' => 'Form-button'])!!}
              {!! Form::close() !!}
            </div>
          <p class="top"><a href="/top">戻る</a></p>
        </div>
    @endforeach

@endsection
