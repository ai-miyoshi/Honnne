@extends('layouts.default')
@section('title', 'アイテム詳細')

@section('content')
<section class="pgae_navi">
  <ul>
    <li><a href="/categories">カテゴリ一覧</a></li>
    <li>&nbsp;>&nbsp;</li>
    <li><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></li>
    <li>&nbsp;>&nbsp;</li>
    <li>{{ $item->name }}</li>
  </ul>
</section>

<section class="item-detail">
    <ul class="title">
      <li><h1>{{ $item->name }}</h1></li>
      <li><p>{{ $item->category->name}}</p></li>
    </ul>

    <div class="score-review">
      <div class="wrap">
        <span class="rate rate{{ $average }}"></span>
      </div>
      <ul class="number">
        <li><p>&nbsp;{{ $average }}<p></li>
        <li class="review"><p><i class="fa fa-commenting" aria-hidden="true"></i>&nbsp;{{ $review_number }}件<p></li>
      <!--   @if (Auth::guest())
          <p class="pointer login-show">レビューを投稿する</p>
        @else
          <li class="add-review"><p>レビューを投稿する<p></li>
        @endif -->
      </ul>
    </div>
    <div class="image-info">
      <img src="/image/{{ $item->image }}" alt="..." class="image">
      <h3>{{ $item->name }}</h3>
      <p>{{ $item->info }}</p>
    </div>
</section>

<section>
    <!-- バリデーションエラーの表示 -->
  @if ($errors->has('title'))
    <span class="error">{{$errors->first('title')}}</span>
  @endif
  @if ($errors->has('body'))
    <span class="error">{{$errors->first('body')}}</span>
  @endif
  @if ($errors->has('score'))
    <span class="error">{{$errors->first('score')}}</span>
  @endif
  <!-- エラーの表示 -->
</section>


<section>
  @if (Auth::guest())
   <p class="pointer login-show">レビューを投稿する</p>
  @else
    <li class="add-review"><p>レビューを投稿する<p></li>
    <form method="post" action="/reviews" class="">
      <!--クロス・サイト・リクエスト・フォージェリ対策 -->
      {{ csrf_field() }}
      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
      <label>タイトル</label>
      <input type="text" name="title" value="{{ old('title') }}"class="">
      <label>レビュー</label>
      <input type="textarea" name="body" value="{{ old('body') }}" class="">
      <label>評価</label>
      <fieldset class="rating">
        <!-- <legend></legend> -->
          <input type="radio" id="star5" name="score" value="5" class="star" /><label for="star5"></label>
          <input type="radio" id="star4" name="score" value="4" /><label for="star4"></label>
          <input type="radio" id="star3" name="score" value="3" /><label for="star3"></label>
          <input type="radio" id="star2" name="score" value="2" /><label for="star2"></label>
          <input type="radio" id="star1" name="score" value="1" /><label for="star1"></label>
      </fieldset>
      <input type="submit" value="投稿" class="">
    </form>
  @endif
</section>

<section><!-- レビューの表示 -->
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


        <p class="evaluation">このレビューは参考になりましたか？</p>
        @if (Auth::guest())
        <p class="pointer login-show">はい</p>
        @else
        <form method="post" action="/items/{{ $review->item_id }}" class="">
          {{ csrf_field() }}
          <input type="hidden" name="review_id" value="{{ $review->id }}">
          <input type="hidden" name="item_id" value="{{ $review->item_id }}">
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          <input type="submit" value="はい" class="">
        </form>
        @endif

        レビューが参考になった（{{ count($review->recommend) }}）
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
            <p class="pointer login-show">コメントを投稿する</p>
          @else <!--ログインしている-->
            <form method="post" action="/comment" class="">
              {{ csrf_field() }} <!--クロス・サイト・リクエスト・フォージェリ対策 -->
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <input type="hidden" name="review_id" value="{{ $review->id }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <label>タイトル</label>
              <input type="text" name="title" value="{{ old('title') }}"class="">
              <label>コメント</label>
              <input type="textarea" name="body" value="{{ old('body') }}" class="">
              <input type="submit" value="投稿" class="">
            </form>
          @endif <!--ログイン判定-->
        </div>

      @else <!--コメント判定start ないとき-->
        <p>コメントを投稿しましょう！</p>
        <div class="comment-add">
          @if (Auth::guest()) <!--ログイン判定start ログインしていない-->
            <p class="pointer login-show">コメントを投稿する</p>
          @else <!--ログインしている-->
            <form method="post" action="/comment" class="">
              {{ csrf_field() }} <!--クロス・サイト・リクエスト・フォージェリ対策 -->
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <input type="hidden" name="review_id" value="{{ $review->id }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <label>タイトル</label>
              <input type="text" name="title" value="{{ old('title') }}"class="">
              <label>コメント</label>
              <input type="textarea" name="body" value="{{ old('body') }}" class="">
              <input type="submit" value="投稿" class="">
            </form>
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
</section>




@endsection
