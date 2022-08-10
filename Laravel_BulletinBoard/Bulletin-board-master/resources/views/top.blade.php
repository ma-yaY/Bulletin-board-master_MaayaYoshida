@extends('layouts.login')
@section('title', '掲示板投稿一覧')
@section('content')
  <div class="category-list">
    <h1>投稿一覧</h1>
    <!--foreach-->
        @foreach($timelines as $timeLine)
          <div class="main-post">
            <div class="box">
              <a class="up_main_post_name">{{$timeLine->user->username}}</a>
              <a href="/users/{{$timeLine->id}}/detail">{{$timeLine->title}}</a>
              <a class="up_main_post_name">{{$timeLine->created_at}}</a>
              <a class="up_main_post">{{$timeLine->postSubCategory->sub_category}}</a>
            </div>
          </div>
              @auth
                <!-- Post.phpに作ったisFavoritedByメソッドをここで使用 -->
                @if (!$timeLine->isFavoritedBy(Auth::user()))
                  <span class="Favorite">
                    <i class="Favorite-toggle fa-solid fa-heart favorite " style="color:red" data-Post-id="{{$timeLine->id}}"></i>
                      <span class="Favorite-counter">{{$timeLine->PostFavorite->count()}}</span>

                  </span>
                  @else
                    <span class="">
                    <i class="Favorite-toggle fa-solid fa-heart  favorited" style="color:red" data-Post-id="{{$timeLine->post->id}}"></i>
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
        @endforeach
      <div id="side-menu">
        <p class="category-btn"><a href="/category">カテゴリーを追加</a></p>
        <p class="up-post"><a href="/post">投稿</a></p>
        <p class="detail"><a href="/detail">自分の投稿</a></p>

          <div class="Search-form">
          {!! Form::open(['url' => '/result']) !!}
          <div class="SearchForm-group">
          {!! Form::input('text', 'keyword', null, ['class' => 'form-ctl', 'placeholder' => '']) !!}
          <div class="input-SearchWord">
          <span class="Form-button">{{ Form::submit('検索')}}</span>
            </div>
          {!! Form::close() !!}
          </div>
      </div>
  </div>

@endsection
