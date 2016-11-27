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

<div>
<ul>
  <li><h1>{{ $item->name }}</h1><li>
  <li>平均評価★★★☆☆</li>
  <li>xxx件のレビュー</li>
  <li>xxx人が質問に回答しました</li>
  <li>I have</li>
</ul>
  <ul>
    <li><img src="/image/{{ $item->image }}" alt="..." class=""></li>
    <li>{{ $item->info }}</li>
  </ul>
</div>
<div>
  <h1>レビュー投稿</h1>
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
  <form method="post" action="/reviews" class="">
    <!--クロス・サイト・リクエスト・フォージェリ対策 -->
    {{ csrf_field() }}
    <input type="hidden" name="item_id" value="{{ $item->id }}">
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
</div>

<div>
  <h1>レビュー表示</h1>
  @forelse ($reviews as $review)
  <ul>
    <li>タイトル：{{ $review->title }}</li>
    <li>
      <div class="wrap">
        <span class="rate rate{{ $review->score }}"></span>
      </div>
    </li>
  </ul>
  <ul>
    <li>投稿者：xxx</li>
    <li>投稿日時{{ $review->time }}</li>
  </ul>
    <p>レビュー内容::{{ $review->body }}</p>
    <p>このレビューは参考になりましたか？ はい/いいえ 違反を報告</p>
    <hr>


    <!-- コメント投稿 -->
    <!-- バリデーションエラーの表示 -->
    <!-- @if ($errors->has('title'))
      <span class="error">{{$errors->first('title')}}</span>
    @endif
    @if ($errors->has('body'))
      <span class="error">{{$errors->first('body')}}</span>
    @endif -->
    <!-- end -->
    <form method="post" action="/comment" class="">
      <!--クロス・サイト・リクエスト・フォージェリ対策 -->
      {{ csrf_field() }}
      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <input type="hidden" name="review_id" value="{{ $review->id }}">
      <label>タイトル</label>
      <input type="text" name="title" value="{{ old('title') }}"class="">
      <label>コメント</label>
      <input type="textarea" name="body" value="{{ old('body') }}" class="">
      <input type="submit" value="投稿" class="">
    </form>


    <!-- コメント表示 -->
    <li>
      @forelse ($review->comment as $comment)
      <div style="background-color:#e6e6fa">
        <p>コメントタイトル：{{ $comment->title }}</p>
        <p>コメント内容：{{ $comment->body }}</p>
      </div>
      @empty
      <div style="background-color:#e6e6fa">
         <p>コメントはありません</p>
       </div>
      @endforelse
    </li>

    <hr>
    <hr>
  @empty
     レビューはありません
  @endforelse

</div>
<div>
  <h1>カスタマーQ&A</h1>
</div>



@endsection
