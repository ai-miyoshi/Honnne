@extends('layouts.default')
@section('title', 'アイテム一覧')

@section('content')



<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">
        <ul class="page-navi">
          <li ><a href="/categories">カテゴリ一覧</a></li>
          <li>&nbsp;>&nbsp;</li>
          <li>{{ $category->name}}</li>
        </ul>
      </div>
    </div><!--row-->
  </div><!--container-->
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">

        <div class="category-title">
          <h2>{{ $category->name}}一覧</h2>
        </div>

        <div class="col-xs-12 col-lg-12 item-index-top-wrapper">
          <div class="items-box">
            <ul>
              @foreach ($items as $item)
              <div class="col-xs-6 col-lg-3">
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
              </div>
              @endforeach
            </ul>
          </div>
          <div class="pagenation">{!! $items->render() !!}</div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-lg-12">
            <div class="col-xs-6 col-lg-6 review-rank category-sidebar">
              <div class="middle-inner-wrappew">
                <h2>HOTな製品</h2>
                <ul>
                @foreach ($CategoryReviewAmount as $amount)
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

            <div class="col-xs-6 col-lg-6 category-sidebar">
              <div class="middle-inner-wrappew">
                <h2>高評価ランキング</h2>
                <ul>
                @foreach ($CategoryScoreRank as $rank)
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
          </div>
        </div>





      </div>
    </div><!--row-->
  </div><!--container-->
</section>


@endsection
