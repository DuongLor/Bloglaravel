<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
			public function create()
    {
        return view('client.post.create');
    }
		public function search(Request $request)
    {
        $keyword = $request->input('q');
        $posts = Post::where('title', 'like', '%' . $keyword . '%')
            ->where('status', 'approved')
            ->with('categories')
            ->paginate(10);
        return view('client.search', compact('posts'));
    }
}
