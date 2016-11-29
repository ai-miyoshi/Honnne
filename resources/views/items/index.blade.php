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
    <p class="top">Category Items</p>
    <hr>
    <p class="bottom">{{ $category->name}}一覧</p>
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
          <div class="wrap items-box-score">
            <span class="rate rate3"></span><!-- 平均スコアの表示-->
          </div>
        </a>
      </li>
      @endforeach
    </ul>
    <div style="text-align:center">ページネーション</div>
  </div>
</article>

<sidebar>
    <div class="sidebar-block">
        <div class="small-title">
            <h2>カテゴリ</h2>
        </div>         <!-- カテゴリ一覧の名前を取ってきておきかえる-->
          <li>
            <div class="sidebar-recipi">
              <p>和食</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>イタリアン</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>フレンチ</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>中華</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>アジアン</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>エスニック</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>&#8194鍋</p>
            </div>
          </li>
          <li>
            <div class="sidebar-recipi">
              <p>デザート</p>
            </div>
          </li>
        </ul>
    </div>
</sidebar>

<aside>
</aside>

@endsection
