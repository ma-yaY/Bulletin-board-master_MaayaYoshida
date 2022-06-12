@extends('layouts.login')

@section('title', '掲示板詳細画面')
    @section('content')
    <!--<h1>掲示板詳細画面</h1>-->
    @foreach ($userPost_ids as $userPost_ids)
      <div class="post-area">

        <a class="user-name">{{$userPost_ids->user->username}}</a>
        <a class="user-title">{{$userPost_ids->title}}</a>
        <a class="user-post">{{$userPost_ids->post}}</a>
        <a class="day-time">{{$userPost_ids->created_at}}</a>
        @foreach ($categories as $categories)
          <a class="Sub-category">{{$categories->sub_category}}</a>


        <p class="category-btn"><a href="/posts/{{$userPost_ids->id}}/edit">編集</a></p>
      </div>

    <div class="form-group">
        {!! Form::open(['url' => 'post/comment'.$userPost_ids->id]) !!}
        <div>{!! Form::textarea('comment', null, ['class' => 'input'=> '投稿内容を入力してください。', 'rows' => 4, 'cols'=> 20]) !!}</div>
        <span class="Form-button">{{ Form::submit('投稿')}}</span>
      {!! Form::close() !!}
    </div>
    <p class="top"><a href="/top">戻る</a></p>
    @endforeach
@endsection
