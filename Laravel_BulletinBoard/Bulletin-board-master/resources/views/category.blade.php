@extends('layouts.login')
@section('title', 'カテゴリー追加画面')
@section('content')
<!--<h1>カテゴリー追加画面</h1>-->
<div class=" Category-area">
      <div class="CategoryForm">
        {!! Form::open(['url' =>'category/create']) !!}
        <div>{{ Form::label('main category') }}</div>
        <div>{{ Form::text('newMain_category',null,['class' => 'input']) }}</div>
        <span class="Form-button">{{ Form::submit('登録')}}</span>
        {!! Form::close() !!}
      </div>
      <!--カテゴリー選択-->
      <div class="SelectCategoryForm">
        {!! Form::open(['url' =>'category/createSub']) !!}
          {{csrf_field()}}
          <label for="MainFormSelect" class="form-label">メインカテゴリー<label>
          <select class="form-select" id="MainFormSelect" name="main_category">
            @foreach ($categories as $select)
            <option value="{{$select->id}}">{{$select->main_category}}</option>
            @endforeach
          </select>
          <!--サブカテゴリー選択-->
          <div class="subForm-group">
            <label class="form-label">新規サブカテゴリー</label>
            <input class="form-control" type="text" name="sub_category">
          </div>
            <button type="submit" class="btn redbtn">登録</button>

        {!! Form::close() !!}
      </div>

    </div>

    <div class="category-list">
    <h1>カテゴリー一覧</h1>
    @foreach ($categories as $main_category)
     <div class="up_category">メインカテゴリー</div>
          <a class="up_main_category">{{$main_category->main_category}}</a>

        <div><a class="up_category">サブカテゴリー</a>
          @foreach ($main_category->PostSubCategory as $sub_category)
            <div class="up_sub_category">{{$sub_category->sub_category}}</div>
            <div class="Danger-btn">
              <a class="btn-danger" href="/category/{{$sub_category->id}}/SubDelete" onclick="return confirm('こちらのサブカテゴリーを削除してもよろしいでしょうか？')">削除</a>
            </div>
          @endforeach
        </div>
    @endforeach
        <p class="top"><a href="/top">戻る</a></p>
</div>

@endsection
