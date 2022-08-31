@extends('layouts.login')
@section('title', 'カテゴリー追加画面')
@section('content')
<!--<h1>カテゴリー追加画面</h1>-->
<div class=" Category-area">
      <div class="CategoryForm">
        @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
        @endforeach
        {!! Form::open(['url' =>'category/create']) !!}
        <div class="main-category">{{ Form::label('main category') }}</div>
        <div>{{ Form::text('newMain_category',null,['class' => 'input newMain_categoryForm']) }}</div>
        {!! Form::submit('登録',['class' => 'main-r-button']) !!}
        {!! Form::close() !!}
        <!--カテゴリー選択-->
          {!! Form::open(['url' =>'category/createSub']) !!}
            {{csrf_field()}}
            <div><label for="MainFormSelect" class="form-label">メインカテゴリー<label></div>
            <select class="form-select" id="MainFormSelect" name="main_category" >
              @foreach ($categories as $select)
              <option value="{{$select->id}}">{{$select->main_category}}</option>
              @endforeach
            </select>
            <!--サブカテゴリー-->
              <div><label class="form-label">新規サブカテゴリー</label></div>
              <div><input class="form-control" type="text" name="sub_category"></div>
              <button type="submit" class="sub-r-btn">登録</button>
          {!! Form::close() !!}
      </div>

    </div>
      <div id="category-list">
        <h1>カテゴリー一覧</h1>

        @foreach ($categories as $main_category)
        <h2 class="up_category">メインカテゴリー</h2>
            <div><a class="up_main_category">{{$main_category->main_category}}</div>
            @if($main_category->PostSubCategory->isEmpty())
            <a class="btn-danger" href="/category/{{$main_category->id}}/MainDelete" onclick="return confirm('こちらのメインカテゴリーを削除してもよろしいでしょうか？')">削除</a>
            @endif
          <h2 class="up_category">サブカテゴリー</h2>
          @foreach ($main_category->PostSubCategory as $sub_category)
            <div><a class="up_sub_category">{{$sub_category->sub_category}}</div>
              @if($sub_category->post->isEmpty())
              <a class="btn-danger" href="/category/{{$sub_category->id}}/SubDelete" onclick="return confirm('こちらのサブカテゴリーを削除してもよろしいでしょうか？')">削除</a></a>
              @endif
          @endforeach

        @endforeach
        <p class="top"><a href="/top">戻る</a></p>
      </div>
</div>

@endsection
