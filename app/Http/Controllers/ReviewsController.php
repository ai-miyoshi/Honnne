<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 名前空間
use App\Item;
use App\Review;
use App\Recommend;
use App\Category;
use View;
use Cookie;


class ReviewsController extends Controller
{
    // レビューの投稿
    public function create(Request $request) {
      // バリデーション
      $this->validate($request, [
        'reviewtitle' => 'required' ,
        'reviewbody'  => 'required',
        'score' => 'required'
      ]);

      // テーブルにレビューを新規登録
      $review = new Review();
      $review->title    = $request->reviewtitle;
      $review->body     = $request->reviewbody;
      $review->score    = $request->score;
      $review->item_id  = $request->item_id;
      $review->user_id  = $request->user_id;
      $review->save();

      // ビューへリダイレクト
      return redirect('/items/'.$review->item_id) ->with('flash_message','レビューを投稿しました。');
    }

    // 「参考になった」ボタンの登録
    public function store(Request $request) {
      // 初めて押したかの判定=Recommend tableにuser_idとreview_idがあるか判定 *exists判定のために->get();を書かない
      $validate = Recommend::where('user_id', '=', $request->user_id)
                           ->where('review_id', '=', $request->review_id);
      // $validateがexistでないならば->新規登録
      if ( !$validate->exists() ) {
        $reco = new Recommend();
        $reco ->user_id = $request ->user_id;
        $reco ->review_id = $request ->review_id;
        $reco ->save();
        // ビューへリダイレクト
        return redirect('/items/'.$request->item_id) ->with('flash_message','レビューが参考になったと登録しました');
      } else {
        // ビューへリダイレクト
        return redirect('/items/'.$request->item_id) ->with('flash_message','参考になったボタンは１回しか押せません');
      }
    }
    
    public function __construct() {
      // カテゴリ一覧表示
      View::share('category_all', Category::all());
      // アイテム一覧表示
      View::share('item_all', Item::all());
      View::share('review_all', Review::all());
    }
}


















