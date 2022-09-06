@extends('layouts.logout')

@section('content')
<div class="New-login">
  <div class="New-login-form">


    <h2>新規ユーザー登録</h2>
    {!! Form::open() !!}
    @foreach ($errors->all() as $error)
    <li class="validate">{{$error}}</li>
    @endforeach

    <div class="label-user-name">{{ Form::label('user name','ユーザー名') }}</div>
    <div>{{ Form::text('username',null,['class' => 'username']) }}</div>

    <div class="label-e-mail">{{ Form::label(' email address','メールアドレス') }}</div>
    <div>{{ Form::text('email',null,['class' => 'mail']) }}</div>

    <div class="label-password">{{ Form::label('password','パスワード') }}</div>
    <div>{{ Form::password('password',['class' => 'password']) }}</div>

    <div class="label-password">{{ Form::label('password confirm','パスワード確認') }}</div>
    <div>{{ Form::password('password_confirmation',['class' => 'password-confirmation']) }}</div>

    {{ Form::submit('確認',['class' => "Form-button"])}}
    <!--<p>ログイン画面へ<a href="/login">戻る</a></p>-->

    {!! Form::close() !!}
  </div>
</div>

@endsection
