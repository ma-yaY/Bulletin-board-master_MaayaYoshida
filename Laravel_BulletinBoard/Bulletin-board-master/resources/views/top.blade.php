@extends('layouts.login')

@section('content')
  <h1>掲示板投稿一覧</h1>

  <div class="category-list">
    <h1>投稿一覧</h1>
    <!--foreach-->
        @foreach($timelines as $timeLine)
          <div class="main-post">
          <a class="up_main_post_name">{{$timeLine->user->username}}</a>
          <a href="/users/{{$timeLine->id}}/detail">{{$timeLine->title}}</a>
          <a class="up_main_post_name">{{$timeLine->created_at}}</a>
          <a class="up_main_post">{{$timeLine->postSubCategory->sub_category}}</a>
          <!--memoにファボボタン試作あり-->
        @endforeach
      </div>
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




@endsection
