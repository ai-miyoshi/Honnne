@extends('layouts.default')
@section('title', '閲覧履歴')

@section('content')

<article>
  <div class="items-box">
  <h3>閲覧履歴</h3>
    @if ($items !== null)
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
    @else
    <ul>
      <li>
        <h4>閲覧履歴はありません</h4>
        <a href="/categories" class="pointer">カテゴリから製品を探す</a>
      </li>
    </ul>
    @endif
  </div>
</article>


@endsection