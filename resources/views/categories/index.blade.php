@extends('layouts.default')
@section('title', 'カテゴリ一覧')

@section('content')



<section class="top-wrapper">
    <div class="row">
      <div class="col-xs-12 col-lg-12">
      </div>
    </div><!--row-->
</section>

<section class="middle-wrapper">
    <div class="row">
      <div class="col-xs-12 col-lg-4 review-rank category-sidebar">
        <div class="middle-inner-wrappew">
          <h2>レビューの多い製品</h2>
          <ul>
          @foreach ($review_amount as $amount)
            <li>
              <div class="sidebar-lank">
                <p></p>
              </div>
              <a href="/items/{{ $amount->item_id }}" class="pointer">
                <img src="/image/{{ $amount->image }}" class="lank-box-image">
                <p class="">{{ $amount->name }}</p>
                <p class="">レビュー数<span class="rank-bold">&nbsp;{{ $amount->review_amount }}&nbsp;</span>件</p>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="col-xs-12 col-lg-4 category-sidebar">
        <div class="middle-inner-wrappew">
          <h2>おすすめ製品</h2>
          <ul>
          @foreach ($scorerank as $rank)
            <li class="reviewrank">
              <div class="sidebar-lank">
                <p></p>
              </div>
              <a href="/items/{{ $rank->item_id }}" class="pointer">
                <img src="/image/{{ $rank->image}}" class="lank-box-image">
                <p class="">{{ $rank ->name }}</p>
                <div class="wrap categories-wrap">
                  <span class="rate rate{{ round($rank ->ave_score, 1) }}"></span>
                </div>
                <div class="averagescore-caategories">&nbsp;{{ round($rank ->ave_score, 1) }}</div>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="col-xs-12 col-lg-4 category-sidebar">
        <div class="middle-inner-wrappew">
          <h2>新着レビュー</h2>
          <ul>
          @foreach ($scorerank as $rank)
            <li class="">
              <a href="/items/{{ $rank->item_id }}" class="pointer">
                <img src="/image/{{ $rank->image}}" class="lank-box-image">
                <p class="">{{ $rank ->name }}</p>
                <div class="wrap categories-wrap">
                  <span class="rate rate{{ round($rank ->ave_score, 1) }}"></span>
                </div>
                <div class="averagescore-caategories">&nbsp;{{ round($rank ->ave_score, 1) }}</div>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

    </div><!--row-->
</section>

<section>
    <div class="row slider-title">
      <div class="col-xs-12 col-lg-12">
        <ul class="slides">
          @foreach ($item_all as $item)
          <li class="slider-items">
            <a href="/items/{{ $item->id }}">
              <div class="col-xs-12 col-lg-12">
                <p class="text-center"><img src="/image/{{ $item->image }}" alt="..." class="slider-image"></p>
                <p class="text-center">{{ $item->name }}</p>
              </div>

              <div class="col-xs-12 col-lg-12">
                <p class="text-center"><span class="rate rate{{ round($item->review->avg('score', 1), 1) }}"></span></p>
              </div>

              <div class="col-xs-12 col-lg-12">
                <p class="text-center"><i class="fa fa-commenting" aria-hidden="true"></i>{{ count($item->review) }}件</p>
              </div>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div><!--row-->
</section>

<!--aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->

@endsection




























