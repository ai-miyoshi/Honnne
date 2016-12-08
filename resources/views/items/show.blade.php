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
          <!-- バリデーションエラーの表示 -->
            @if ($errors->has('score'))
            <div class="review-valid-error">
              <span class="error">{{$errors->first('score')}}</span>
            </div>
            @endif
          <!-- エラーの表示 -->

          <div class="form-group">
            <label for="review-title-boot" class="col-sm-2 control-label">タイトル</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="" name="reviewtitle" value="{{ old('title') }}" id="review-title-boot">
            </div>
          </div>
          <!-- バリデーションエラーの表示 -->
            @if ($errors->has('reviewtitle'))
            <div class="review-valid-error">
              <span class="error">{{$errors->first('reviewtitle')}}</span>
            </div>
            @endif
          <!-- エラーの表示 -->

          <div class="form-group">
            <label for="review-body-boot" class="col-sm-2 control-label">レビュー内容</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="3" name="reviewbody" value="{{ old('body') }}" id="review-body-boot"></textarea>
            </div>
          </div>
          <!-- バリデーションエラーの表示 -->
            @if ($errors->has('reviewbody'))
            <div class="review-valid-error">
              <span class="error">{{$errors->first('reviewbody')}}</span>
            </div>
            @endif
          <!-- エラーの表示 -->

          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">投稿</button>
            </div>
          </div>
        </form>
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
        <li class="title"><p>{{ $review->title }}</p></li>
      </ul>
      <ul>
        <li>投稿者&nbsp;
          <span class="review-name-color">{{$review->user->name}}</span>
          &nbsp;&nbsp;投稿日&nbsp;{{ date("Y/m/j",strtotime($review->created_at)) }}
        </li>
      </ul>
      <div class="review-body-deco">{{ $review->body }}</div>
      <ul>

        <li><p>&nbsp;<span class="review-name-color">{{ count($review->recommend) }}</span>人の歯科医師がこのレビューが参考になったと考えています。このレビューは参考になりましたか？&nbsp;</p></li>
        @if (Auth::guest())
         <li><a href="{{ url('/login') }}" class="btn btn-default btn-xs">はい</a></li>
        @else
          <li>
          <form method="post" action="/items/{{ $review->item_id }}" class="form-horizontal add-review-form">
            {{ csrf_field() }}
            <input type="hidden" name="review_id" value="{{ $review->id }}">
            <input type="hidden" name="item_id" value="{{ $review->item_id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="submit" value="はい" class="btn btn-default btn-xs">
          </form>
          </li>
        @endif
      </ul>


      <div class="review-comments">
        <div class="commentshowup pointer">
          <ul>
            <li>{{ count($review->comment) }}&nbsp;コメント</li>
            @if (Auth::guest()) <!--ログイン判定start ログインしていない-->
            <li><a href="{{ url('/login') }}" class="btn btn-default btn-xs comment-btn-position">コメントを書く</a></li>
            @else <!--ログインしている-->
            <li class="btn btn-default btn-xs comment-btn-position">コメントを書く</li>
            @endif
          </ul>
        </div>

        <div class="comment-body">
          @foreach ($review->comment as $comment)
          <div class="comment-show-body">
            <ul>
              <li><p>{{$comment->user->name}}さんのコメント&nbsp;</p></li>
              <li class="text-right">&nbsp;投稿日&nbsp;{{ date("Y/m/j",strtotime($comment->created_at)) }}</li>
            </ul>
            <p class="comment-body-style">{{ $comment->body }}</p>
          </div>
          @endforeach

          @if (Auth::guest()) <!--ログイン判定start ログインしていない-->
          @else <!--ログインしている-->
          <p class="comment-add-form">コメントを投稿する</p>
            <form method="post" action="/comment" class="comment-forms">
              {{ csrf_field() }} <!--クロス・サイト・リクエスト・フォージェリ対策 -->
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <input type="hidden" name="review_id" value="{{ $review->id }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="commenttitle" value="aaa">

              <div class="form-group">
                <label for="comment-body-boot" class="col-sm-2 control-label">コメント</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="" name="commentbody" value="{{ old('body') }}" id="comment-body-boot">
                </div>
              </div>
              <input type="submit" value="投稿" class="btn btn-default btn-xs">
              <!-- バリデーションエラーの表示 -->
                @if ($errors->has('commentbody'))
                <div class="review-valid-error">
                  <span class="error">{{$errors->first('commentbody')}}</span>
                </div>
                @endif
              <!-- エラーの表示 -->
            </form>

          @endif
        </div><!--comment-body-->
      </div><!--review-comments-->

    </div><!--user-review-->








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
