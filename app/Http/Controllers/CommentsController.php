<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 名前空間
use App\Item;
use App\Review;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request) {
      // バリデーション
      $this->validate($request, [
        'commenttitle' => 'required',
        'commentbody' => 'required',
      ]);
// dd($request);
      // コメントの保存
      $comment = new Comment();
      $comment->title = $request->commenttitle;
      $comment->body = $request->commentbody;
      $comment->review_id = $request->review_id;
      $comment->user_id = $request->user_id;
      $comment->save();

      // ビューにリダイレクト
      return redirect('items/'.$request->item_id) ->with('flash_message','レビューにコメントを記載しました！');
    }
}
