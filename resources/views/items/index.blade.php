@extends('layouts.default')
@section('title', 'アイテム一覧')

@section('content')

<h1>アイテム一覧</h1>
@foreach ($items as $item)
<a href="/item/{{ $item->id }}"> <!-- ルーティングにid渡す -->
  <ul>
    <li>{{ $item->name }}</li>
    <li><img src="/image/{{ $item->image }}" alt="..." class=""></li>
    <li>{{ $item->info }}</li>
  </ul>
</a>
@endforeach

@endsection
