<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 名前空間
use App\Item;
use App\Review;
use App\Recommend;


class ReviewsController extends Controller
{
    // レビューの投稿
    public function create(Request $request) {
      // バリデーション
      $this->validate($request, [
        'title' => 'required | max:30 | min:2',
        'body' => 'required | min:5',
        'score' => 'required'
      ]);

      // テーブルにレビューを新規登録
      $review = new Review();
      $review->title  = $request->title;
      $review->body  = $request->body;
      $review->score  = $request->score;
      $review->item_id = $request->item_id;
      $review->save();

      // ビューへリダイレクト
      return redirect('/items/'.$review->item_id) ->with('flash_message','レビューを投稿しました。');
    }

    // 参考になったの登録
    public function store(Request $request) {
      // テーブルに新規登録
      //ログイン判定
      // if () {
        $recomennd = new Recommend();
        $recomennd ->user_id = $request ->user_id;
        $recomennd ->review_id = $request ->review_id;
        $recommend ->save();
        dd($recommend);
      // }
      // ビューへリダイレクト
      return redirect('/items/'.$recommend->item_id) ->with('flash_message','レビューが参考になったと登録しました');
    }
}
