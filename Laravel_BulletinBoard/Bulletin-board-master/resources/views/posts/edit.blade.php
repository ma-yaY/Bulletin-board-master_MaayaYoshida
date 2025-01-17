@extends('layouts.login')
@section('title', '投稿編集画面')
@section('content')
<!--<h1>投稿編集画面</h1>-->
    @foreach ($userPost_ids as $userPost_ids)
      <div class="edit-Post">
      {!! Form::open(['url' => 'posts/Edit'.$userPost_ids->id]) !!}
      <p class="SubCategory-form">サブカテゴリー</p>

        @foreach ($errors->all() as $error)
            <li class="validate">{{ $error }}</li>
          @endforeach
        <div class="select-container"><select class="editForm-select" id="SubFormSelect" name="upSub_category" >
        <option value="" selected>{{$userPost_ids->postSubCategory->sub_category}}</option>
        @foreach ($SubCategories as $main_categories)
            @foreach ($main_categories->PostSubCategory as $sub_category)
              <option value="{{$sub_category->id}}"  >{{
              $sub_category->sub_category}}</option>
            @endforeach
        @endforeach
      </select></div>

      <p class="title-form">タイトル</p>
      @foreach ($errors->get('upTitle') as $error)
      <li class="validate">{{ $error }}</li>
      @endforeach
      <div>{{ Form::text('upTitle', $userPost_ids->title,['class' => 'input edit-title']) }}</div>
      <p class="post-form">投稿内容</p>
      @foreach ($errors->get('upPost') as $error)
      <li class="validate">{{ $error }}</li>
      @endforeach
        <div>{!! Form::textarea('upPost', $userPost_ids->post, ['class' => 'editForm-control', 'rows' => 4, 'cols'=> 20]) !!}</div>
        <div class="submit-btn">
          <button type="submit" class="btn-button-close" href="/posts/{{$userPost_ids->id}}/detail">更新</button>
        </div>
        {!! Form::close() !!}
        <div class="Post-BtnDanger">
          <a type="submit" class="Post-btn-danger" href="/post/{{$userPost_ids->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
        </div>
      </div>
    @endforeach
@endsection
