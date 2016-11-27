<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Review;


class CategoriesController extends Controller
{
    //カテゴリ一覧表示
    public function index() {
      // カテゴリ一覧表示
      $categories = Category::all();
      //製品一覧表示
      $items = Item::all();
      // viewにデータを渡す
      return view('categories.index', ['categories'=> $categories, 'items'=>$items ]);
    }
}
