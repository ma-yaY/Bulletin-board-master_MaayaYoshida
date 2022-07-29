@extends('layouts.login')
@section('title', '投稿編集画面')
@section('content')
<!--<h1>投稿編集画面</h1>-->
    <h2>投稿内容</h2>
    @foreach ($userPost_ids as $userPost_ids)
        {!! Form::open(['url' => 'posts/Edit'.$userPost_ids->id]) !!}
        <p class="SubCategory-form">サブカテゴリー</p>

          <select class="form-select" id="SubFormSelect" name="Sub_category">
              @foreach ($SubCategorys as $Sub_categories)
              <option value="{{$Sub_categories->id}}">{{
              $Sub_categories->postSubCategory->sub_category}}</option>
              @endforeach
          </select>

        <p class="title-form">タイトル</p>
        <div>{{ Form::text('upTitle', $userPost_ids->title,['class' => 'input']) }}</div>
        <p class="title-form">コメント</p>
        <div>{!! Form::textarea('upPost', $userPost_ids->post, ['class' => 'input', 'rows' => 4, 'cols'=> 20]) !!}</div>

        <div class="submit-btn">
          <button type="submit" class="btn btn-button-close" href="/posts/{{$userPost_ids->id}}/detail">更新</button>
        </div>

        {!! Form::close() !!}
    @endforeach
        <div class="Danger-btn">
          <a class="btn-danger" href="/post/{{$userPost_ids->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
        </div>
@endsection
