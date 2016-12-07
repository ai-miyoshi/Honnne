@extends('layouts.default')
@section('title', '検索結果')

@section('content')

<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-lg-12">

        <div class="items-box">
        <h3>検索ワード&nbsp;"{{ $keyword }}"</h3>
        <h3>検索結果</h3>
          <ul>
            @forelse ($result_search as $item)
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
            @empty
            <li>
              <h4>検索ワード&nbsp;"{{ $keyword }}"に該当する製品はありません</h4>
              <a href="/categories" class="pointer">カテゴリから製品を探す</a>
            </li>
            @endforelse
          </ul>
          <div class="pagenation">{!! $result_search->render() !!}</div>
        </div>

      </div>
    </div><!--row-->
  </div><!--container-->
</section>

@endsection