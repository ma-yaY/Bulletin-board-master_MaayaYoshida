@extends('layouts.login')
@section('title', '投稿編集画面')
@section('content')
<!--<h1>投稿編集画面</h1>-->
    <h2>投稿内容</h2>
    @foreach ($userPost_ids as $userPost_ids)
        {!! Form::open(['url' => 'post/edit']) !!}
        <p class="SubCategory-form">サブカテゴリー</p>

          <select class="form-select" id="SubFormSelect" name="Sub_category">
              @foreach ($SubCategorys as $Select)
              <option value="{{$Select->id}}">{{$Select->sub_category}}</option>
              @endforeach
          </select>

        <p class="title-form">タイトル</p>
        <div>{{ Form::text('upTitle', $userPost_ids->title,['class' => 'input']) }}</div>
        <p class="title-form">コメント</p>
        <div>{!! Form::textarea('upPost', $userPost_ids->post, ['class' => 'input', 'rows' => 4, 'cols'=> 20]) !!}</div>

        <div class="submit-btn">
          <button type="submit" class="btn btn-button-close" href="/post/{{$userPost_ids->id}}/detail">更新</button>
        </div>
        <div class="Danger-btn">
          <button><a class="btn-danger" href="post/{{$userPost_ids->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><div class="trash-image">削除</div></a></button>
        </div>
      </div>
        {!! Form::close() !!}

    @endforeach
@endsection
