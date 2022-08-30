@extends('layouts.login')

@section('title', 'コメント編集画面')
@section('content')
    <h2>コメント内容</h2>
      @foreach ($Comment_ids as $Comment_ids)
        {!! Form::open(['url' => 'posts/Comment_edit'.$Comment_ids->id]) !!}
          <div class='commentEditForm'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <div>{!! Form::textarea('upComment', $Comment_ids->comment, ['class' => 'input', 'rows' => 4, 'cols'=> 20]) !!}</div>
            <!--post_idも送ることでどの投稿のコメントかが判別-->
            <div>{!! Form::hidden('post_id', $Comment_ids->post_id) !!}</div>
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
