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
  <!-- バリデーションエラーの表示 -->
  @if ($errors->has('title'))
    <span class="error">{{$errors->first('title')}}</span>
  @endif
  @if ($errors->has('body'))
    <span class="error">{{$errors->first('body')}}</span>
  @endif
  @if ($errors->has('score'))
    <span class="error">{{$errors->first('score')}}</span>
  @endif
  <!-- エラーの表示 -->
  <form method="post" action="/reviews" class="">
    <!--クロス・サイト・リクエスト・フォージェリ対策 -->
    {{ csrf_field() }}
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <label>タイトル</label>
    <input type="text" name="title" value="{{ old('title') }}"class="">
    <label>レビュー</label>
    <input type="textarea" name="body" value="{{ old('body') }}" class="">
    <label>評価</label>
    <select name="score">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <input type="submit" value="レビュー投稿" class="">
  </form>

  <h1>レビュー表示</h1>
  <ul>
  @forelse ($reviews as $review)
    <p>レビュー{{ $review->id }}</p>
    <li>タイトル：{{ $review->title }}</li>
    <li>レビュー：{{ $review->body }}</li>
  @empty
     レビューはありません
  @endforelse
  </ul>

</div>

@endsection
