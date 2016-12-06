<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

// 名前空間の指定
use App\Category;
use App\Item;
use App\Review;
use App\Recommend;
use View;
use Cookie;

// ページネーション
// use DB;
// use App\Http\Controllers\Controller;

class ItemsController extends Controller
{

    public function __construct() {
      // カテゴリ一覧表示
      View::share('category_all', Category::all());
      // アイテム一覧表示
      View::share('item_all', Item::all());
      View::share('review_all', Review::all());
    }

    // 閲覧履歴の表示
    public function history() {
      // クッキーの取り出し
      $ids = Cookie::get('items');
      $items = null;
      if ($ids !== null) {
        // item_idで取り出し
        $items = Item::whereIn('id', $ids)->paginate(5);
      }
      return view('items.history', ['items'=> $items]);
    }

    // アイテム個別ページ
    // レビュー一覧表示
    // コメント表示
    public function show($id) {
      //itemテーブルから指定されたidの情報を取得
      $item = Item::findOrFail($id);
      // itemの属するカテゴリを取得
      $category = $item->category;
      //アイテムに関連づいたレビューの取得
      $reviews = $item->review;
      // レビュー数
      $length = count($reviews);
      //評価の平均
      $total=0;
      if ($length == 0) {
        $average = '評価なし';
      } else {
        $average = round($reviews->avg('score'), 1);
      }

      // 閲覧履歴クッキー登録
      $minutes = 30;
      // Cookieから値を取得
      $value = Cookie::get('items');
      if( !$value ) {
        $value = [];
      }
      $value[] = (int) $id;
      // Cookie添付
      Cookie::queue('items', $value, $minutes);

      // ログインリダイレクト用アクション
      Cookie::queue('url', "/items/$id", $minutes);

      // アイテム個別ページにreviewsとしてデータを送る(review有無分岐はviewで)
      return view('items.show', ['reviews'=> $reviews, 'item'=> $item, 'category' => $category, 'average' =>$average, 'review_number'=> $length ]);
    }
    // ログインリダイレクトアクション
    public function loginRedirect(){
      $url =Cookie::get('url');
      if ($url == null) {
        $url = '/categories';
      }
      return redirect($url);
    }

    //あるカテゴリのitem一覧表示
    public function index($id) {
      //カテゴリテーブルから$idに対応した行を取得
      $category = Category::findOrFail($id);

      // $categoryに紐付いているitemsの取得
      $items = Item::where('category_id', $category->id)->paginate(5);

      // カテゴリの評価点ランキング
      $CategoryScoreRank = Item::getCategoryReviewRank($id);
      // カテゴリのレビュー数ランキング
      $CategoryReviewAmount = Item::getCategoryReviewamount($id);


      // viewに$catogoryと$itemsを渡し、移動
      return view('items.index')->with(['category' => $category, 'items' => $items, 'CategoryScoreRank'=>$CategoryScoreRank, 'CategoryReviewAmount'=>$CategoryReviewAmount]);
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

      // 在庫管理画面 アイテムを新規登録
      $item = new Item();
      $item->name  = $request->name;
      $item->info  = $request->info;
      $item->image = $request->image;
      $item->category_id = $request->category_id;
      $item->save();

      // ビューへリダイレクト
      return redirect('/admin') ->with('flash_message','商品'.$item->name.'を新規登録しました');
    }


    // 検索
    public function search(Request $request) {
      $keyword = $request->search;
      $result_search = Item::where('name', 'like', "%{$request->search}%" )->paginate(5);
      // ビューにリダイレクト
      return view('items.search',['result_search'=> $result_search, 'keyword'=> $keyword]);
    }

}
