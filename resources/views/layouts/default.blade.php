<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <!-- タイトル -->
    <title>@yield('title')</title>
    <!-- スタイルシート -->
    <!-- default.blade.phpのシート -->
    <link rel="stylesheet" href="/css/default.css">
    <!-- fontawesome -->
    <script src="https://use.fontawesome.com/34d33137ab.js"></script>
  </head>

  <body>
    <header>
      <div class="header-logo">
        <h1 class="top">歯医者の本音</h1>
        <p class="bottom">歯医者による歯医者のための情報サイト</p>
      </div>

      <div class="header-search">
        <form>
          <input type="text" name="search" value="" class="form header-form">
          <input type="submit" value="検索" class="btn">
        </form>
      </div>

      <div class="header-right">
        <ul>
          <li><a href="/login" class="rogin">ログイン<a></li>
          <li><a href="/register" class="rogin">新規登録<a></li>
          <li><a href="" class="rogin">閲覧履歴<a></li>
          <li><a href="" class="rogin">ご利用ガイド<a></li>
        </ul>
      </div>
    </header>

    <div class="container">
      <!-- セッションメッセージの表示 -->
      @if (session('flash_message') )
      <div class="flash_message"><i class="fa fa-bell" aria-hidden="true"></i>&nbsp;{{session('flash_message')}}</div>
      @endif
      <!-- セッションメッセージの表示 -->

      <!-- 個別ベージの呼び出し -->
        @yield('content')
      <!-- 個別ページの呼び出し -->

    <footer>
      <p><small>Copyright&nbsp;©&nbsp;Ai&nbsp;MiyoshiL&nbsp;&nbsp;All&nbsp;Rights&nbsp;Reserved.</small></p>
    </footer>

    </div><!-- conteiner -->

  <!-- JavaScript -->
  <!-- JavaScript -->

  </body>
</html>
