<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentAdminController extends Controller
{
	//
	public function index()
	{
		$comments = Comment::latest()->paginate(5);
		return view('admin.comment.index', compact('comments'));
	}
	public function show($id)
	{
		$comment = Comment::find($id);
		return view('admin.comment.show', compact('comment'));
	}
	public function reply(Request $request, $id)
	{
		$request->validate([
			'content' => 'required',
		]);
		$comment = new Reply();
		$comment->content = $request->content;
		$comment->user_id = Auth::user()->id;
		$comment->comment_id = $id;
		$comment->save();
		return redirect()->back()->with('success', 'Thêm bình luận thành công');
	}
}