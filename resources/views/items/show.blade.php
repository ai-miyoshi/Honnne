@extends('layouts.default')
@section('title', 'アイテム詳細')

@section('content')


<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">

      </div>
    </div><!--row-->
  </div><!--container-->
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">
        <ul class="page-navi">
          <li><a href="/categories">カテゴリ一覧</a></li>
          <li>&nbsp;>&nbsp;</li>
          <li><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></li>
          <li>&nbsp;>&nbsp;</li>
          <li>{{ $item->name }}</li>
        </ul>
      </div>
    </div><!--row-->
  </div><!--container-->
</section>


<section class="item-detail">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">

        <ul class="title">
          <li><h1>{{ $item->name }}</h1></li>
          <li><p><a href="/categories/{{ $category->id }}">{{ $item->category->name}}</a></p></li>
        </ul>

        <div class="score-review">
          <div class="wrap">
            <span class="rate rate{{ $average }}"></span>
          </div>
          <ul class="number">
            <li><p>&nbsp;{{ $average }}<p></li>
            <li class="review"><p><i class="fa fa-commenting" aria-hidden="true"></i>&nbsp;{{ $review_number }}件<p></li>
          </ul>
        </div>

        <div class="image-info">
          <img src="/image/{{ $item->image }}" alt="..." class="image">
          <h3>{{ $item->name }}</h3>
          <p>{{ $item->info }}</p>
        </div>

          </div>
    </div><!--row-->
  </div><!--container-->
</section>



<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">

  @if (Auth::guest())
    <a href="{{ url('/login') }}" class="btn btn-warning btn-lg btn-block">レビューを投稿する</a>
  @else
  <h4 class="add-review-form-title">レビューの投稿</h4>
    <form method="post" action="/reviews" class="form-horizontal add-review-form">
      <!--クロス・サイト・リクエスト・フォージェリ対策 -->
      {{ csrf_field() }}

      <div class="form-group">
        <label for="review-score-boot" class="col-sm-2 control-label">評価</label>
        <div class="col-sm-10">
          <fieldset class="rating" id="review-score-boot">
            <!-- <legend></legend> -->
              <input type="radio" id="star5" name="score" value="5" class="star" /><label for="star5"></label>
              <input type="radio" id="star4" name="score" value="4" /><label for="star4"></label>
              <input type="radio" id="star3" name="score" value="3" /><label for="star3"></label>
              <input type="radio" id="star2" name="score" value="2" /><label for="star2"></label>
              <input type="radio" id="star1" name="score" value="1" /><label for="star1"></label>
          </fieldset>
        </div>
      </div>

      <div class="form-group">
        <label for="review-title-boot" class="col-sm-2 control-label">タイトル</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="" name="reviewtitle" value="{{ old('title') }}" id="review-title-boot">
        </div>
      </div>

      <div class="form-group">
        <label for="review-body-boot" class="col-sm-2 control-label">レビュー内容</label>
        <div class="col-sm-10">
          <textarea class="form-control" rows="3" name="reviewbody" value="{{ old('body') }}" id="review-body-boot"></textarea>
        </div>
      </div>

      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">投稿</button>
        </div>
      </div>
    </form>

    <!-- バリデーションエラーの表示 -->
    @if ($errors->has('reviewtitle'))
      <span class="error">{{$errors->first('reviewtitle')}}</span>
    @endif
    @if ($errors->has('reviewbody'))
      <span class="error">{{$errors->first('reviewbody')}}</span>
    @endif
    @if ($errors->has('score'))
      <span class="error">{{$errors->first('score')}}</span>
    @endif
    <!-- エラーの表示 -->

  @endif

          </div>
    </div><!--row-->
  </div><!--container-->
</section>

<section><!-- レビューの表示 -->
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">

   <h3>ユーザーレビュー</h3>
  @forelse ($reviews as $review)<!-- レビューの取り出しstart -->
    <div class="user-review">
      <ul >
        <li class="score">
          <div class="wrap">
            <span class="rate rate{{ $review->score }}"></span>
          </div>
        </li>
        <li class="title"><h4>{{ $review->title }}</h4></li>
      </ul>
      <ul>
        <li>投稿者名:{{$review->user->name}}</li>
        <li>投稿日時{{ date("Y年m月j日 H時i分",strtotime($review->created_at)) }}</li>
      </ul>
        <p>{{ $review->body }}</p>

        <p>{{ count($review->recommend) }}人がレビューが参考になったと言っています。</p>
        <p class="evaluation">このレビューは参考になりましたか？</p>
        @if (Auth::guest())
          <a href="{{ url('/login') }}">はい</a>
        @else
        <form method="post" action="/items/{{ $review->item_id }}" class="">
          {{ csrf_field() }}
          <input type="hidden" name="review_id" value="{{ $review->id }}">
          <input type="hidden" name="item_id" value="{{ $review->item_id }}">
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          <input type="submit" value="はい" class="">
        </form>
        @endif
      </div>

    <div class="review-comments">
      @if (count($review->comment) != 0 ) <!--コメント判定start あるとき-->
        <div class="commentshowup pointer">
          <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;レビューへのコメントを見る&nbsp;({{ count($review->comment) }})
        </div><!--commentshowup pointer-->
        <div class="comment-body" >
          @foreach ($review->comment as $comment)
            <ul>
              <li><h4>{{ $comment->title }}</h4></li>
              <li><p>投稿者{{$comment->user->name}}</p></li>
              <li>投稿日{{ date("Y年m月j日 H時i分",strtotime($comment->created_at)) }}</li>
            </ul>
            <p>{{ $comment->body }}</p>
          @endforeach
        </div>


        <div class="comment-add">
          @if (Auth::guest()) <!--ログイン判定start ログインしていない-->
            <a href="{{ url('/login') }}">レビューを投稿する</a>
          @else <!--ログインしている-->
            <form method="post" action="/comment" class="">
              {{ csrf_field() }} <!--クロス・サイト・リクエスト・フォージェリ対策 -->
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <input type="hidden" name="review_id" value="{{ $review->id }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <label>タイトル</label>
              <input type="text" name="commenttitle" value="{{ old('title') }}"class="">
              <label>コメント</label>
              <input type="textarea" name="commentbody" value="{{ old('body') }}" class="">
              <input type="submit" value="投稿" class="">
            </form>

            <!-- バリデーションエラーの表示 -->
            @if ($errors->has('commentbody'))
              <span class="error">{{$errors->first('commentbody')}}</span>
            @endif
            @if ($errors->has('commenttitle'))
              <span class="error">{{$errors->first('commenttitle')}}</span>
            @endif
            <!-- エラーの表示 -->

          @endif <!--ログイン判定-->
        </div>

      @else <!--コメント判定start ないとき-->
        <p>コメントを投稿しましょう！</p>
        <div class="comment-add">
          @if (Auth::guest()) <!--ログイン判定start ログインしていない-->
            <a href="{{ url('/login') }}">コメントを投稿する</a>
          @else <!--ログインしている-->
            <form method="post" action="/comment" class="">
              {{ csrf_field() }} <!--クロス・サイト・リクエスト・フォージェリ対策 -->
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <input type="hidden" name="review_id" value="{{ $review->id }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <label>タイトル</label>
              <input type="text" name="commenttitle" value="{{ old('title') }}"class="">
              <label>コメント</label>
              <input type="textarea" name="commentbody" value="{{ old('body') }}" class="">
              <input type="submit" value="投稿" class="">
            </form>

            <!-- バリデーションエラーの表示 -->
            @if ($errors->has('commentbody'))
            <span class="error">{{$errors->first('commentbody')}}</span>
            @endif
            @if ($errors->has('commenttitle'))
            <span class="error">{{$errors->first('commenttitle')}}</span>
            @endif
            <!-- エラーの表示 -->

          @endif<!--ログイン判定end-->
        </div>

      @endif<!--コメント判定end あるとき-->

    </div>


  @empty<!-- レビューの取り出し ないとき -->
   <ul class="number review-empty">
     <li>レビューはありません</li>
     <li class="add-review"><p>レビューを投稿する<p></li>
   </ul>
  @endforelse<!-- レビューの取り出しend-->

      </div>
    </div><!--row-->
  </div><!--container-->
</section>




@endsection
