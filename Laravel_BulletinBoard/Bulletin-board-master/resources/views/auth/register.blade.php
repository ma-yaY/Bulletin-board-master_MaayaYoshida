@extends('layouts.logout')

@section('content')
<div class="New-login">
  <div class="New-login-form">

    {!! Form::open() !!}
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
    <h2>新規ユーザー登録</h2>

    <div class="label-user-name">{{ Form::label('user name') }}</div>
    <div>{{ Form::text('username',null,['class' => 'username']) }}</div>

    <div class="label-e-mail">{{ Form::label(' email address') }}</div>
    <div>{{ Form::text('email',null,['class' => 'mail']) }}</div>

    <div class="label-password">{{ Form::label('password') }}</div>
    <div>{{ Form::password('password',null,['class' => 'password']) }}</div>

    <div class="label-password">{{ Form::label('password confirm') }}</div>
    <div>{{ Form::password('password_confirmation',null,['class' => 'password']) }}</div>

    {{ Form::submit('確認',['class' => "Form-button"])}}
    <!--<p>ログイン画面へ<a href="/login">戻る</a></p>-->

    {!! Form::close() !!}
  </div>
</div>

@endsection
