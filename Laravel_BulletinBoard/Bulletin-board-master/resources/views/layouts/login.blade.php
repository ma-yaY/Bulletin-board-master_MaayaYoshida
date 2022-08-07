<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bulletin-Board</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
        <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
</head>
<body>
  <title>@yield('title')</title>
  @yield('title')
  <a href="/logout">ログアウト</a>
  @yield('content')
  <script type="text/javascript" src="Favorite.js"></script>
</body>
</html>
