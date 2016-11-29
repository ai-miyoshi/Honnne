<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Review;
use View;


class CategoriesController extends Controller
{   //このコントローラで遷移するすべてのviewに値を渡す
    //※名前空間を書くのを忘れずに use View;
    public function __construct() {
      // カテゴリ一覧表示
      View::share('category_all', Category::all());

      // アイテム一覧表示
      View::share('item_all', Item::all());
      //ユーザー定義関数を呼び出して使用することも可能
      //ユーザー定義関数はコントローラと関連するモデルに記載する
      // View::share('rankings', Category::getRanking());
    }


    //カテゴリ一覧表示
    public function index() {
      //category一覧、item一覧表示はconstructで
      return view('categories.index');
    }


    //あるカテゴリのitem一覧表示
    public function show($id) {
      //カテゴリテーブルから$idに対応した行を取得
      $category = Category::findOrFail($id);

      // $categoryに紐付いているitemsの取得
      $items = $category->items;

      // viewに$catogoryと$itemsを渡し、移動
      return view('items.index')->with(['category' => $category, 'items' => $items]);
    }

}
