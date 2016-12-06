<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Review;
use View;
use Cookie;


class CategoriesController extends Controller
{   //このコントローラで遷移するすべてのviewに値を渡す
    //※名前空間を書くのを忘れずに use View;
    public function __construct() {
      // カテゴリ一覧表示
      View::share('category_all', Category::all());
      // アイテム一覧表示
      View::share('item_all', Item::all());
      View::share('review_all', Review::all());
    }
    // public function __construct($id) {
    //   //itemテーブルから指定されたidの情報を取得
    //   $item = Item::findOrFail($id);
    //   //アイテムに関連づいたレビューの取得
    //   $reviews = $item->review;
    //   // レビューの平均点の計算
    //     // れびゅーの数
    //     $length = count($reviews);
    //     $total=0;
    //     foreach ($reviews as $review) {
    //       $score = $review->score;
    //       $total = $score + $total;
    //     }
    //     $average = round($total / $length , 1) ;
    //   View::share['review_length'=> $length, 'score_average' => $average];



    //カテゴリ一覧表示
    public function index() {
      // 評価ランキング
      $scorerank = Item::getReviewRank();
      // レビュー数ランキング
      $review_amount = Item::getReviewamount();
      // ログインリダイレクト用アクション
      Cookie::queue('url', "/", 10);
      //category一覧、item一覧表示はconstructで
      return view('categories.index', [ 'scorerank'=> $scorerank, 'review_amount'=> $review_amount ]);

    }



}
