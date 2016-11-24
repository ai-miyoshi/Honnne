<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

// 名前空間の指定
use App\Item; //itemモデルの指定
use App\Review;

class ItemsController extends Controller
{
    //アイテム一覧表示アクション
    public function index() {
      // Itemテーブルのすべての情報を取得
      $items = Item::all();

      // viewに名前：itemsとして$itemsを渡し、viewに移動
      return view('items.index')->with('items', $items);
      }

    // アイテム個別ページ + レビュー一覧表示アクション
    public function show($id) {

      //itemテーブルから指定されたidの情報を取得
      $item = Item::findOrFail($id);

      //アイテムに関連づいたレビューの一覧表示
        // item_id = $id のレビューの取得
        $reviews = Review::where('item_id', $id)->get();
        // アイテム個別ページにreviewsとしてデータを送る(review有無分岐はviewで)
        return view('items.show', ['reviews'=> $reviews, 'item'=> $item]);
    }
}
