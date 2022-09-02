@extends('layouts.login')
@section('title', '新規投稿画面')
@section('content')
<!--<h1>新規投稿画面</h1>-->
<div class="PostForm-area">
      <div class="PostForm-group">
        {!! Form::open(['url' => 'post/create']) !!}
      <div><label for="SubFormSelect" class="SubForm-label">サブカテゴリー<label></div>
        <select class="SubForm-select" id="SubFormSelect" name="Sub_category">
            @foreach ($Sub_categories as $select)
                <option value="{{$select->id}}">{{$select->sub_category}}</option>
            @endforeach
        </select>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
          <div class ="label-title">{!! Form::label('title') !!}</div>
          <div>{{ Form::text('title',null,['class' => 'input title']) }}</div>
          <div class = "label-PostForm">{!! Form::label('textarea') !!}</div>
          <div>{!! Form::textarea('newPost', null, ['class' => 'PostForm-control', 'placeholder' => '投稿内容を入力してください。', 'rows' => 4, 'cols'=> 20]) !!}</div>
          <span>{{ Form::submit('投稿',[ 'class' => 'Form-button'])}}</span>
            {!! Form::close() !!}
    </div>
</div>


@endsection
