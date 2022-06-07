@extends('layouts.logout')

@section('content')
<div class="login">
  <div class="login-form">

    {!! Form::open() !!}

    <h2>ログイン画面</h2>

    <div>{{ Form::label('e-mail') }}</div>
    <div>{{ Form::text('email',null,['class' => 'input']) }}</div>
    <div>{{ Form::label('password') }}</div>
    <div>{{ Form::password('password',['class' => 'input']) }}</div>

    <span class="Form-button">{{ Form::submit('ログイン') }}</span>

    <p><a href="/register">新規ユーザーの方はこちら</a></p>

    {!! Form::close() !!}
  <div>
</div>
@endsection
