<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    ////データ作成時に入力を許可するカラムの指定
    protected $fillable = ['name', 'image', 'info'];

    // item->reviews
    public function review() {
      return $this->hasMany('App\Review');
    }
    // item->category
    public function category() {
      return $this->belongsTo('App\Category');
    }

    // 全体の評価点ランキング
    public static function getReviewRank() {
    return \DB::select('SELECT * from items INNER JOIN (SELECT item_id,avg(score) as ave_score FROM reviews GROUP BY item_id) as ave on items.id = ave.item_id ORDER BY ave_score DESC limit 3');
    }
    // 全体のレビュー数ランキング
    public static function getReviewamount(){
    return \DB::select('SELECT * from items INNER JOIN (SELECT COUNT(*) AS review_amount, item_id FROM reviews GROUP BY item_id) as amount on items.id = amount.item_id ORDER BY review_amount DESC limit 3');
    }
    // カテゴリの評価点ランキング
    public static function getCategoryReviewRank( $coategory_number ){
    return \DB::select("SELECT * from items INNER JOIN (SELECT item_id,avg(score) as ave_score FROM reviews GROUP BY item_id) as ave on items.id = ave.item_id where items.category_id = $coategory_number ORDER BY ave_score DESC limit 3");
    }
    // カテゴリのレビュー数ランキング
    public static function getCategoryReviewamount( $coategory_number ){
    return \DB::select("SELECT * from items INNER JOIN (SELECT COUNT(*) AS review_amount, item_id FROM reviews GROUP BY item_id) as amount on items.id = amount.item_id where items.category_id = $coategory_number ORDER BY review_amount DESC limit 3");
    }

}
