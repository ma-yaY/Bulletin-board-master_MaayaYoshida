@extends('layouts.login')

@section('title', '掲示板詳細画面')
@section('content')
    <h2>コメント内容</h2>
    @foreach ($Comment_ids as $Comment_ids)
      {!! Form::open(['url' => 'post/commentEdit'.$Comment_ids->id]) !!}

          <div class='commentEditForm'>
            <div>{!! Form::textarea('upComment', $Comment_ids->comment, ['class' => 'input']) !!}</div>
          </div>

          {!! Form::close() !!}
    @endforeach

          <div class="submit-btn">
              <button type="submit" class="btn btn-button-close" href="/post/detail">更新</button>
          </div>
          <div Class="Danger-btn">
            <button><a class="btn-danger" href="post/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><div class="trash-image">削除</div></a></button>
          </div>
@endsection
