<?php

namespace App\Http\View\Composers;

use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\View\View;

class LayoutComposer
{
  public function compose(View $view)
  {
    $categories = Category::all();
    $top_10_new_comment = Comment::orderBy('created_at', 'desc')->take(10)->get();
    $data = [
      'categories' => $categories,
      'top_10_new_comment' => $top_10_new_comment
    ];
    $view->with($data);
  }
}