@extends('layouts.default')
@section('title', 'カテゴリ一覧')

@section('content')
<section class="category-index">
  <div class="category-title">
    <p class="top">Category List</p>
    <hr>
    <p class="bottom">カテゴリ一覧</p>
  </div>

  <div class="category-box">
    <ul>
      @foreach ($categories as $category)
      <li>
        <a href="/categories/{{ $category->id }}" class="pointer">
          <image src="/image/{{ $category->image }}" class="category-box-image">
          <p class="category-box-name">{{ $category->name }}</p>
        </a>
      </li>
      @endforeach
    </ul>
  </div>
  <sidebar class="category-sidebar">
    <ul>
      <li class="lank-title">評価点ランキング</li>
      <li class="first">
        <div class="sidebar-lank">
          <p class="first">第1位</p>
        </div>
        <a href="/categories/{{ $category->id }}" class="pointer">
          <image src="/image/{{ $category->image }}" class="lank-box-image">
          <p class="">製品名</p>
          <p class="">スコア</p>
        </a>
      </li>
      <hr>
      <li class="sidebar-second">
        <div class="sidebar-lank">
          <p class="second">第2位</p>
        </div>
        <a href="/categories/{{ $category->id }}" class="pointer">
          <image src="/image/{{ $category->image }}" class="lank-box-image">
          <p class="">製品名</p>
          <p class="">スコア</p>
        </a>
      </li>
      <hr>
      <li class="sidebar-third">
        <div class="sidebar-lank">
          <p class="third">第3位</p>
        </div>
        <a href="/categories/{{ $category->id }}" class="pointer">
          <image src="/image/{{ $category->image }}" class="lank-box-image">
          <p class="">製品名</p>
          <p class="">スコア</p>
        </a>
      </li>
    </ul>
  </sidebar>
</section>

<section class="item_index">
  <div class="category-title">
    <p class="top">Item List</p>
    <hr>
    <p class="bottom">アイテム一覧</p>
  </div>
  <!-- 画像スクロール -->
  <div id="scroller_roll1" class="scroller_roll">
    <ul>
      @foreach ($items as $item)
      <li><a href="/items/{{ $item->id }}" title="{{ $item->name }}"><img src="/image/{{ $item->image }}"></a></li>
      @endforeach
  < /ul>
  </div>
</section>



@endsection
