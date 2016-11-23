<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

// 名前空間の指定
use App\item; //itemモデルの指定

class ItemsController extends Controller
{
    //アイテム一覧表示アクション
    public function index() {
      // Itemテーブルのすべての情報を取得
      $items = Item::all();
      // viewに名前：itemsとして$itemsを渡し、viewに移動
      return view('items.index')->with('items', $items);
    }

    // アイテム個別ページ表示アクション
    public function show($id) {     // ルーティングから受け取ったidを引数に受け取る
      //itemテーブルから指定されたidの情報を取得
      $item = Item::findOrFail($id);
      // viewに名前：itemとして$itemを渡し、viewに移動
      return view('items/show')->with('item', $item);
    }
}
