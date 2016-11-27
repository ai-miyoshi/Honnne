@extends('layouts.default')
@section('title', '製品登録')

@section('content')

<h1>製品新規登録</h1>
<!-- エラーの表示 -->
@if ($errors->has('name'))
  <span class="error">{{$errors->first('name')}}</span>
@endif
@if ($errors->has('img'))
<span class="error">{{$errors->first('img')}}</span>
@endif


<!-- 商品の新規登録 -->
<h1>商品の追加</h1>
<form method="post" action="/admin" class="">
  {{ csrf_field() }}
  <div class="">
    <label>商品名</label>
    <input type="text" class="" name="name">
    <small>*必須項目</small>
  </div>
  <div class="">
    <label>商品説明</label>
    <input type="textarea" class="" name="info">
    <small>*必須項目</small>
  </div>
  <div class="">
    <label>商品画像</label>
    <input type="file" class="" name="image">
    <small>*.png .jpgのみ</small>
  </div>
  <div class="">
    <label>カテゴリ</label>
    <input type="text" class="" name="category_id">
  </div>
  <p>
    <input type="submit" value="商品を新規登録する" class="">
  </p>
</form>

@endsection
