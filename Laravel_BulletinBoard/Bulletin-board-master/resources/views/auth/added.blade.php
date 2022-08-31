@extends('layouts.logout')

@section('content')

<div id="clear">
  <h2>{{ session('username') }}さん</h2>
  <h2>登録ありがとうございます</h2>


  <button class="btn-login"><a href="/login">ログイン画面へ</a></button>
</div>

@endsection
