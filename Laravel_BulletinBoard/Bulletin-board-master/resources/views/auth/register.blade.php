@extends('layouts.logout')

@section('content')
<div class="New-login">
  <div class="New-login-form">

    {!! Form::open() !!}
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
    <h2>新規ユーザー登録</h2>

    <div>{{ Form::label('user name') }}</div>
    <div>{{ Form::text('username',null,['class' => 'input']) }}</div>

    <div>{{ Form::label(' email address') }}</div>
    <div>{{ Form::text('email',null,['class' => 'input']) }}</div>

    <div>{{ Form::label('password') }}</div>
    <div>{{ Form::text('password',null,['class' => 'input']) }}</div>

    <div>{{ Form::label('password confirm') }}</div>
    <div>{{ Form::text('password_confirmation',null,['class' => 'input']) }}</div>

    <span class="Form-button">{{ Form::submit('確認')}}</span>

    <p><a href="/login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}
  </div>
</div>

@endsection
