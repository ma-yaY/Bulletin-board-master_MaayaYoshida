@extends('layouts.login')
@section('title', '新規投稿画面')
@section('content')
<!--<h1>新規投稿画面</h1>-->
<div class="form-area">
      <div class="form-group">
        {!! Form::open(['url' => 'post/create']) !!}
      <label for="SubFormSelect" class="form-label">サブカテゴリー<label>
        <select class="form-select" id="SubFormSelect" name="Sub_category">
          @foreach ($Sub_categories as $select)
          <option value="{{$select->id}}">{{$select->sub_category}}</option>
          @endforeach
        </select>
      <div>{{ Form::label('title') }}</div>
      <div>{{ Form::text('title',null,['class' => 'input']) }}</div>
      <div>{!! Form::textarea('newPost', null, ['class' => 'form-control', 'placeholder' => '投稿内容を入力してください。', 'rows' => 4, 'cols'=> 20]) !!}</div>
      <span class="Form-button">{{ Form::submit('投稿')}}</span>
      {!! Form::close() !!}
    </div>
</div>


@endsection
