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
  <link rel="stylesheet" href="/css/default.css">
  <link rel="stylesheet" href="/css/category_index.css">
  <link rel="stylesheet" href="/css/items_index.css">
  <link rel="stylesheet" href="/css/items_show.css">
  <link rel="stylesheet" href="/css/bootstrap.min.css">




  <!-- fontawesome -->
  <script src="https://use.fontawesome.com/34d33137ab.js"></script>
  <!-- スクリプト -->
  <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
  <!-- yamaguchi -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="/js/jquery.webticker.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
</head>

<body>

<header>
  <div class="container">
    <div class="row">

      <div class="col-xs-4 col-lg-4 header-left">
        <a href="/categories" class="header-logo" ><h1 class="top">歯医者の本音</h1></a>
        <div>
          <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="dropdown">
              <a href="#" class="dropdown-toggle" id="drop4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                カテゴリー <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" id="menu1" aria-labelledby="drop4">
                  @foreach ($category_all as $category)
                  <li class="sidebar-block">
                    <div class="sidebar-category">
                      <p><a href="/categories/{{ $category->id }}" class="pointer">{{ $category->name }}</a></p>
                    </div>
                  </li>
                  @endforeach
              </ul>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-xs-4 col-lg-4 header-middle">
        <div class="input-group">
          <form method="post" action="/search" >
          {{ csrf_field() }}
            <span class="input-group-btn">
              <input type="text" class="form-control" name="search"  placeholder="Search" value="{{ $keyword or "" }}">
              <button class="btn btn-default" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </span>
          </form>
        </div>
      </div>

      <div class="col-xs-4 col-lg-4 header-right">
        @if (Auth::guest())
        <ul class="nav nav-pills">
          <li role="presentation" class="pointer"><a href="{{ url('/login') }}"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;ログイン</li></a>
          <li class="pointer"><a href="{{ url('/register') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;新規登録</li></a>
          <li><a href="/items/history" class="pointer"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;閲覧履歴</a></li>
        </ul>
        @else
        <ul class="nav nav-pills">
          <li role="presentation" class="active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
              </li>
            </ul>
          </li>
          <li><a href="/items/history" class="pointer"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;閲覧履歴</a></li>
        </ul>
        @endif
      </div>

    </div><!--row-->
  </div><!--container-->
</header>

<section class="flash-message-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">
        <!-- セッションメッセージの表示 -->
        @if (session('flash_message') )
        <div class="flash_message">
          <p><i class="fa fa-bell" aria-hidden="true"></i>&nbsp;{{session('flash_message')}}</p>
        </div>
        @endif
      </div>
    </div><!--row-->
  </div><!--container-->
</section>


<!-- 個別ベージの呼び出し -->
@yield('content')


<!-- フッター -->
<footer>
  <div><small>Copyright&nbsp;©&nbsp;Ai&nbsp;MiyoshiL&nbsp;&nbsp;All&nbsp;Rights&nbsp;Reserved.</small></div>
</footer>

<!-- JavaScript -->
  <script src="/js/script.js"></script>
<!-- JavaScript -->
</body>
</html>


















