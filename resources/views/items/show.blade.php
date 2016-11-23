@extends('layouts.default')
@section('title', 'アイテム詳細')

@section('content')
<a href="/items"><small>アイテム一覧に戻る</a>
<h1>アイテム個別ページ</h1>
<div>
  <ul>
    <li>{{ $item->name }}</li>
    <li><img src="/image/{{ $item->image }}" alt="..." class=""></li>
    <li>{{ $item->info }}</li>
  </ul>
</div>

<div>
  <h1>レビュー投稿</h1>
  <h1>レビュー表示</h1>
</div>

@endsection
