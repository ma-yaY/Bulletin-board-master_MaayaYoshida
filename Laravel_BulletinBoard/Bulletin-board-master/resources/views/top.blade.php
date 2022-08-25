@extends('layouts.login')
@section('title', '掲示板投稿一覧')
@section('content')
  <div class="category-list">
    <!--foreach-->
        @foreach($timelines as $timeLine)
          <div class="main-post">
            <div class="box">
              <a class="up_main_post_name">{{$timeLine->user->username}}さん</a>
              <a class="up_main_post_name">{{$timeLine->created_at}}</a>
              <a class="View">{{$timeLine->ActionLog->count()}}View</a>
              <div class="post-itle">
                <a href="detail/{{$timeLine->id}}">{{$timeLine->title}}</a>
              </div>
              <a class="up_main_post">{{$timeLine->postSubCategory->sub_category}}</a>
              <a class="ComenntCount">{{$timeLine->PostComment->count()}}コメント数</a>
              @auth
                <!-- Post.phpに作ったisFavoritedByメソッドをここで使用 -->

                @if (!$timeLine->isFavoritedBy(Auth::user()))
                  <span class="Favorite">
                    <i class="Favorite-toggle far fa-heart favorite" style="color:red"  data-Post-id="{{$timeLine->id}}"></i>
                      <span class="Favorite-counter">{{$timeLine->PostFavorite->count()}}</span>
                  </span>
                  @else
                    <span class="Favorited">
                    <i class="Favorite-toggle fas fa-heart favorited" style="color:red" data-Post-id="{{$timeLine->id}}"></i>
                      <span class="Favorite-counter">{{$timeLine->PostFavorite->count()}}</span>
                    </span>

                @endif
              @endauth
              @guest
                <span class="Favorite">
                  <i class="fa-solid fa-heart"></i>
                <span class="Favorite-counter">{{$timeLine->PostFavorite->count()}}</span>
                </span>
              @endguest
            </div>
          </div>
        @endforeach
      <div id="side-menu">
        <p class="category-btn"><a href="/category">カテゴリーを追加</a></p>
        <p class="up-post"><a href="/post">投稿</a></p>

        {!! Form::open(['url' => '/myPost']) !!}
          {!! Form::submit('自分の投稿',['class' => 'myPost-button']) !!}
        {!! Form::close() !!}

          <div class="Search-form">
          {!! Form::open(['url' => '/result']) !!}
            {!! Form::input('text', 'keyword', null, ['class' => 'form-ctl', 'placeholder' => '']) !!}
          {{ Form::submit('検索'),['class' => 'Form-button']}}
          {!! Form::close() !!}
          </div>
      </div>
  </div>

@endsection
