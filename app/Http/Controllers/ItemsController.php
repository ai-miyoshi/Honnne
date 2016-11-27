<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

// 名前空間の指定
use App\Category;
use App\Item; //itemモデルの指定
use App\Review;

class ItemsController extends Controller
{
    //アイテム一覧表示アクション
    public function index($id) {
      //カテゴリテーブルから$idに対応した行を取得
      $category = Category::findOrFail($id);

      // $categoryに紐付いているitemsの取得
      $items = $category->items;

      // viewに$catogoryと$itemsを渡し、移動
      return view('items.index')->with(['category' => $category, 'items' => $items]);
      }


    // アイテム個別ページ + レビュー一覧表示+レビューへのコメント表示アクション
    public function show($id) {
      //itemテーブルから指定されたidの情報を取得
      $item = Item::findOrFail($id);
      // itemの属するカテゴリを取得
      $category = $item->category;
      //アイテムに関連づいたレビューの取得
      $reviews = $item->review;
      // アイテム個別ページにreviewsとしてデータを送る(review有無分岐はviewで)
      return view('items.show', ['reviews'=> $reviews, 'item'=> $item, 'category' => $category]);
    }


    // 製品追加ページ表示
    public function create() {
      // /items/createにアクセスするとcreate.blade.phpに飛ぶ
      return view('items.create');
    }


    // 製品の保存
    public function store(Request $request) {
      // バリデーション
      $this->validate($request, [
      'name' => 'required | max:20',
      'info' => 'required',
      // 'img'  => 'required | mimes:jpeg,jpg,png,JPG,PNG',
      ]);

      // 在庫管理画面　アイテムを新規登録
      $item = new Item();
      $item->name  = $request->name;
      $item->info  = $request->info;
      $item->image = $request->image;
      $item->category_id = $request->category_id;
      $item->save();

      // ビューへリダイレクト
      return redirect('/admin') ->with('flash_message','商品'.$item->name.'を新規登録しました');
    }
}
