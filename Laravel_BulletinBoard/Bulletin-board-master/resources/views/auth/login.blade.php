@extends('layouts.logout')

@section('content')
<div class="login">
  <div class="login-form">

    {!! Form::open() !!}

    <h2>ログイン</h2>

    <div class="label-e-mail" >{{ Form::label('e-mail','メールアドレス') }}</div>
    <div>{{ Form::text('email',null,['class' => 'mail']) }}</div>
    <div class="label-password">{{ Form::label('password','パスワード') }}</div>
    <div>{{ Form::password('password',['class' => 'password']) }}</div>

    {{ Form::submit('ログイン',['class' => "Form-button"]) }}

    <p>新規ユーザーの方は<a href="/register">こちら</a></p>

    {!! Form::close() !!}
  <div>
</div>
@endsection
