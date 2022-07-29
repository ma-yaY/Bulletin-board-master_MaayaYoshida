@extends('layouts.login')

@section('title', '掲示板詳細画面')
@section('content')
    <h2>コメント内容</h2>
      @foreach ($Comment_ids as $Comment_ids)
        {!! Form::open(['url' => 'posts/Comment_edit'.$Comment_ids->id]) !!}
          <div class='commentEditForm'>
            <div>{!! Form::textarea('upComment', $Comment_ids->comment, ['class' => 'input', 'rows' => 4, 'cols'=> 20]) !!}</div>
          </div>
          <div class="submit-btn">
              <button type="submit" class="btn btn-button-close" href="/posts/{{$Comment_ids->id}}/Comment_edit">更新</button>
          </div>
        {!! Form::close() !!}
      @endforeach
          <div class="Danger-btn">
            <a class="btn-danger" href="/post/{{$Comment_ids->id}}/CommentDelete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
          </div>
@endsection
