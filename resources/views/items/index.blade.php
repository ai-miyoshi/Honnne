@extends('layouts.default')
@section('title', 'アイテム一覧')

@section('content')

<section>
  <ul class="page-navi">
    <li ><a href="/categories">カテゴリ一覧</a></li>
    <li>&nbsp;>&nbsp;</li>
    <li>{{ $category->name}}</li>
  </ul>
</section>

<section>
  <div class="category-title">
    <h3>{{ $category->name}}一覧</h3>
  </div>
</section>

<sidebar>
    <div class="sidebar-block">
        <div class="small-title">
          <p>カテゴリ一覧</p>
        </div>         <!-- カテゴリ一覧の名前を取ってきておきかえる-->
        <ul>
          @foreach ($category_all as $category)
          <li>
            <div class="sidebar-category">
              <a href="/categories/{{ $category->id }}" class="pointer">{{ $category->name }}</a>
            </div>
          </li>
          @endforeach
        </ul>
    </div>
</sidebar>


<article>
  <div class="items-box">
    <ul>
      @foreach ($items as $item)
      <li class="item-box">
        <a href="/items/{{ $item->id }}">
          <img src="/image/{{ $item->image }}" alt="..." class="item-box-image">
          <p class="items-box-name">{{ $item->name }}</p>
          <ul class="review-score-box">
            <li>
              <div class="wrap items-box-score">
                <p><span class="rate rate{{ round($item->review->avg('score', 1), 1) }}"></span></p>
                <p>{{ round($item->review->avg('score', 1), 1) }}点</p>
              </div>
            </li>
            <li>
              <div class="review-number">
                <p><i class="fa fa-commenting" aria-hidden="true"></i></p>
                <p>{{ count($item->review) }}件</p>
              </div>
            </li>
          </ul>
        </a>
      </li>
      @endforeach
    </ul>
    <div class="pagenation">{!! $items->render() !!}</div>
  </div>
</article>

<sidebar>
  <div class="sidebar-block category-sidebar">
  <div>
      <h3>高評価ランキング</h3>
      <ul>
      @foreach ($CategoryScoreRank as $rank)
        <li class="reviewrank">
          <div class="sidebar-lank">
            <p></p>
          </div>
          <a href="/items/{{ $rank->item_id }}" class="pointer">
            <img src="/image/{{ $rank->image}}" class="lank-box-image">
            <p class="">{{ $rank ->name }}</p>
            <p class="">{{ round($rank ->ave_score, 1) }}</p>
            <div class="wrap">
              <span class="rate rate{{ round($rank ->ave_score, 1) }}"></span>
            </div>
          </a>
        </li>
        @endforeach
      </ul>
    </div>

    <div class="reviewamount-rank">
      <h3>レビュー数ランキング</h3>
      <ul>
      @foreach ($CategoryReviewAmount as $amount)
        <li>
          <div class="sidebar-lank">
            <p></p>
          </div>
          <a href="/items/{{ $amount->item_id }}" class="pointer">
            <img src="/image/{{ $amount->image }}" class="lank-box-image">
            <p class="">{{ $amount->name }}</p>
            <p class="">{{ $amount->review_amount }}件</p>
          </a>
        </li>
        @endforeach
      </ul>
    </div>

  </div>
</sidebar>

<aside>
</aside>

@endsection
