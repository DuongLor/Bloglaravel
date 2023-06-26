<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
		public function index(){
			$posts = Post::paginate(5);
			return view('client.home', ['posts' => $posts] );
		}


}
