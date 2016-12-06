@extends('layouts.default')
@section('title', 'カテゴリ一覧')

@section('content')
<section>
  <ul class="page-navi">
    <li ><a href="/categories">カテゴリ一覧</a></li>
    <li>&nbsp;>&nbsp;</li>
  </ul>
</section>

<section class="category-index">
  <div class="category-box">
   <h3>カテゴリ一覧</h3>
    <div class="category-boxs">
      <ul>
        @foreach ($category_all as $category)
        <li>
          <a href="/categories/{{ $category->id }}" class="pointer">
            <img src="/image/{{ $category->image }}" class="category-box-image">
            <p class="category-box-name">{{ $category->name }}</p>
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

  <sidebar class="category-sidebar">
    <div >
      <h3>高評価ランキング</h3>
      <ul>
      @foreach ($scorerank as $rank)
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
      @foreach ($review_amount as $amount)
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
  </sidebar>

</section>





<ul class="slides">
  @foreach ($item_all as $item)
  <li>
    <a href="/items/{{ $item->id }}">
      <img src="/image/{{ $item->image }}" alt="...">
      <p >{{ $item->name }}</p>
      <p><span class="rate rate{{ round($item->review->avg('score', 1), 1) }}"></span></p>
      <p>{{ round($item->review->avg('score', 1), 1) }}点</p>
      <p><i class="fa fa-commenting" aria-hidden="true"></i></p>
      <p>{{ count($item->review) }}件</p>
    </a>
  </li>
  @endforeach
</ul>



<!-- JavaScript -->
  <!--画像スクロール  -->
  <script type="text/javascript" src="/js/scroller_roll.js"></script>
  <script type="text/javascript" src="/js/scroller_roll2.js"></script>
@endsection
