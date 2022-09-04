@extends('layouts.login')
@section('title', '投稿編集画面')
@section('content')
<!--<h1>投稿編集画面</h1>-->
    @foreach ($userPost_ids as $userPost_ids)
    <div class="edit-Post">
        {!! Form::open(['url' => 'posts/Edit'.$userPost_ids->id]) !!}
        <p class="SubCategory-form">サブカテゴリー</p>

          <select class="editForm-select" id="SubFormSelect" name="Sub_category">
              @foreach ($SubCategorys as $Sub_categories)
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
                <option value="{{$Sub_categories->id}}">{{
                $Sub_categories->postSubCategory->sub_category}}</option>
              @endforeach
          </select>

        <p class="title-form">タイトル</p>
        @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
        @endforeach
        <div>{{ Form::text('upTitle', $userPost_ids->title,['class' => 'input edit-title']) }}</div>
        <p class="title-form">コメント</p>
        @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
        @endforeach
        <div>{!! Form::textarea('upPost', $userPost_ids->post, ['class' => 'editForm-control', 'rows' => 4, 'cols'=> 20]) !!}</div>
         <div class="submit-btn">
          <button type="submit" class="btn-button-close" href="/posts/{{$userPost_ids->id}}/detail">更新</button>
        </div>
        {!! Form::close() !!}
    @endforeach
  </div>
        <div class="Post-BtnDanger">
          <a type="submit" class="Post-btn-danger" href="/post/{{$userPost_ids->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
        </div>


@endsection
