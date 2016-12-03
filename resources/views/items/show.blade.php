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
        <li class="add-review"><p>レビューを投稿する<p></li>
      </ul>
    </div>
    <div class="image-info">
      <img src="/image/{{ $item->image }}" alt="..." class="image">
      <h3>{{ $item->name }}</h3>
      <p>{{ $item->info }}</p>
    </div>
</section>

<section>
  <h3>ユーザーレビュー</h3>
  @forelse ($reviews as $review)
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
      <li>投稿者xxx</li>
      <li>投稿日時{{ date("Y年m月j日 H時i分",strtotime($review->created_at)) }}</li>
    </ul>
      <p>{{ $review->body }}</p>


      <p class="evaluation">このレビューは参考になりましたか？</p>
      <form method="post" action="/items/{{ $review->item_id }}" class="">
        <input type="hidden" name="review_id" value="{{ $review->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="submit" value="はい" class="">
      </form>


       <p>違反を報告</p>
  </div>
  <!--  -->
  <div class="review-comments">
    <div class="commentshowup pointer">
    @if (count($review->comment) != 0 )
      <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;レビューへのコメントを見る&nbsp;({{ count($review->comment) }})
    </div>
    <div class="comment-body" >
      @foreach ($review->comment as $comment)
        <h4>{{ $comment->title }}</h4>
        <p>{{ $comment->body }}</p>
      @endforeach
    </div>
    @else
    <p>コメントを投稿しましょう！</p>
    @endif
    </div>
    <div class="create-comment">
      <p>コメントを投稿</p>
        <form method="post" action="/comment" class="">
          {{ csrf_field() }} <!--クロス・サイト・リクエスト・フォージェリ対策 -->
          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <input type="hidden" name="review_id" value="{{ $review->id }}">
          <label>タイトル</label>
          <input type="text" name="title" value="{{ old('title') }}"class="">
          <label>コメント</label>
          <input type="textarea" name="body" value="{{ old('body') }}" class="">
          <input type="submit" value="投稿" class="">
        </form>
      </div>




    <!-- コメント表示 -->


<!-- コメント投稿 -->
    <!-- バリデーションエラーの表示 -->
    <!-- @if ($errors->has('title'))
      <span class="error">{{$errors->first('title')}}</span>
    @endif
    @if ($errors->has('body'))
      <span class="error">{{$errors->first('body')}}</span>
    @endif -->
    <!-- end -->


    <hr>
    <hr>

  @empty
   <ul class="number review-empty">
     <li>レビューはありません</li>
     <li class="add-review"><p>レビューを投稿する<p></li>
   </ul>
  @endforelse
</section>




@endsection
