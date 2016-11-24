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
    <link rel="stylesheet" href="/css/style.css">
    <!-- fontawesome -->
    <script src="https://use.fontawesome.com/34d33137ab.js"></script>
  </head>
  <body>
    <header>
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
