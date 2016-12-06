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

  <!-- 画像スクロール -->
  <link href="/css/scroller_roll.css" rel="stylesheet" type="text/css">

  <!-- fontawesome -->
  <script src="https://use.fontawesome.com/34d33137ab.js"></script>
  <!-- スクリプト -->
  <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>



</head>

<body>
  <header>
    <div class="header-logo">
      <a href="/categories">
        <h1 class="top">歯医者の本音</h1>
        <p class="bottom">歯医者による歯医者のための情報サイト</p>
      </a>
    </div>

    <div class="header-search">
      <form method="post" action="/search" >
      {{ csrf_field() }}
        <input type="submit" value="" class="search-btn">
        <input type="text" name="search" placeholder="Search" class="header-form" value="{{ $keyword or "" }}">
      </form>
    </div>

    <div class="header-right">
      <ul>
      <!-- ログイン判定 -->
      @if (Auth::guest())
        <li class="pointer login-show"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;ログイン</li>
        <li class="pointer signup-show"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;新規登録</li>
      @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
      @endif
      <li><a href="/items/history" class="pointer"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;閲覧履歴</a></li>
<!--       <li><a href="" class="pointer"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;ご利用ガイド</a></li>
 -->      </ul>
    </div>
  </header>


<!-- 新規登録モーダル -->
  <div class="signup-modal-wrapper" id="signup-modal">
    <div class="modal">
      <div>
        <i class="fa fa-2x fa-times" id="close-modal"></i>
      </div>
      <div id="signup-form">
        <h2>新規登録</h2>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn" id="submit-btn">
                        Register
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- 新規登録モーダルここまで -->

  <!-- ログインモーダル -->
  <div class="login-modal-wrapper" id="signup-modal">
    <div class="modal">
      <div>
        <i class="fa fa-2x fa-times" id="close-modal2"></i>
      </div>
      <div id="signup-form">
        <h2>ログイン</h2>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> 次回から入力を省く
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn" id="submit-btn">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        パスワードを忘れたときは
                    </a>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ログインモーダルここまで -->


  <div class="container">
    <!-- セッションメッセージの表示 -->
    @if (session('flash_message') )
    <div class="flash_message">
      <i class="fa fa-bell" aria-hidden="true"></i>&nbsp;{{session('flash_message')}}
    </div>
    @endif
    <!-- セッションメッセージの表示ここまで -->

    <!-- JavaScript -->
      <script src="/js/script.js"></script>
    <!-- JavaScript -->

    <!-- 個別ベージの呼び出し -->
    @yield('content')

  </div><!-- conteiner -->

  <!-- フッター -->
  <footer>
    <p><small>Copyright&nbsp;©&nbsp;Ai&nbsp;MiyoshiL&nbsp;&nbsp;All&nbsp;Rights&nbsp;Reserved.</small></p>
  </footer>



</body>
</html>
