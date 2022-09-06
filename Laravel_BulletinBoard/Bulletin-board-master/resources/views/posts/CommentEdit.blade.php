@extends('layouts.login')

@section('title', 'コメント編集画面')
@section('content')
      @foreach ($Comment_ids as $Comment_ids)
      <div class="edit-Post">
        <h2>コメント</h2>
        {!! Form::open(['url' => 'posts/Comment_edit'.$Comment_ids->id]) !!}
          <div class='commentEditForm'>
            @foreach ($errors->all() as $error)
                <li class="validate">{{ $error }}</li>
            @endforeach
            <div>{!! Form::textarea('upComment', $Comment_ids->comment, ['class' => ' CommentForm-control', 'rows' => 4, 'cols'=> 20]) !!}</div>
            <!--post_idも送ることでどの投稿のコメントかが判別-->
            <div>{!! Form::hidden('post_id', $Comment_ids->post_id) !!}</div>
          </div>
          <div class="submit-btn">
              <button type="submit" class="btn btn-button-close" href="/posts/{{$Comment_ids->id}}/Comment_edit">更新</button>
          </div>
        {!! Form::close() !!}
        <div class="Comment-danger-btn">
            <a class="Comment-btn-danger" href="/post/{{$Comment_ids->id}}/CommentDelete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
          </div>
      </div>
      @endforeach

@endsection
