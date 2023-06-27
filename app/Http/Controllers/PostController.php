<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	//
	public function index()
	{
		// $posts = Post::all();
		// my post and pagination simple
		$posts = Post::where('user_id', Auth::user()->id)->latest()->paginate(5);
		foreach ($posts as $post) {
			$selectedCategories = $post->categories()->pluck('name')->implode(', ');
			$post->selectedCategories = $selectedCategories;
		}

		return view('client.post.index', compact('posts'));
	}
	public function create()
	{
		$categories = Category::all();
		return view('client.post.create', compact('categories'));
	}
	public function store(Request $request)
	{
		// validate
		$request->validate([
			'title' => 'required',
			'content' => 'required',
			'short_content' => 'required|max:255',
			'categories' => 'required|array',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

		]);

		$image = $request->file('image');
		$newName = time() . "." . $image->getClientOriginalExtension();

		$blog = new Post();
		$blog->title = $request->title;
		$blog->content = $request->content;
		$blog->short_content = $request->short_content;
		$blog->user_id = Auth::user()->id;
		$blog->image = $newName;
		$blog->save();
		// move file image to uploads
		$image->move(public_path('uploads'), $newName);
		$selectedCategories = $request->input('categories', []);
		$blog->categories()->sync($selectedCategories);

		session()->flash('success', 'Dữ liệu đã được tạo thành công.');
		return redirect()->route('post.index');
	}

	// public function upload(Request $request){
	// 	if($request->hasFile('image')){
	// 		$image = $request->file('image');
	// 		$newname = time() . "." . $image->getClientOriginalExtension();
	// 		$file->move(public_path('uploads'), $newname);

	// 	}
	// }

	public function show(string $id)
	{

		$post = Post::find($id);
		$user = $post->user;

		return view('client.post.show', compact('post', 'user'));
	}

	public function edit(string $id)
	{
		$post = Post::find($id);
		$categories = Category::all();
		$selectedCategories = $post->categories()->pluck('name')->toArray();
		return view('client.post.edit', compact('post', 'categories', 'selectedCategories'));
	}

	public function update(Request $request, string $id)
	{
		$request->validate([
			'title' => 'required',
			'content' => 'required',
			'short_content' => 'required|max:255', // Giới hạn độ dài tối đa của short_content là 255 ký tự
			'categories' => 'required|array',
		]);

		$blog = Post::find($id);
		$blog->title = $request->title;
		$blog->content = $request->content;
		$blog->user_id = Auth::user()->id;
		$blog->status = 'pending';

		if ($request->hasFile('image')) {
			$request->validate([
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra tính hợp lệ của file image
			]);
			//   check file exists
			if (file_exists(public_path('uploads/' . $blog->image))) {
				unlink(public_path('uploads/' . $blog->image));
			}

			$image = $request->file('image');
			$newName = time() . "." . $image->getClientOriginalExtension();
			$image->move(public_path('uploads'), $newName);
			$blog->image = $newName;
		}

		$blog->save();

		$selectedCategories = $request->input('categories', []);
		$blog->categories()->sync($selectedCategories); // Cập nhật danh mục liên quan đến bài viết

		session()->flash('success', 'Dữ liệu đã được sửa thành công.');
		return redirect()->route('post.index');
	}

	public function upload(Request $request){
		if($request->hasFile('upload')){
			$file = $request->file('upload');
			$newname = time() . "." . $file->getClientOriginalExtension();
			$file->move(public_path('uploads'), $newname);
			$url = asset('uploads/' . $newname);

			return response()->json(['filename' => $newname, "uploaded" => 1, 'url' => $url]);
		}
	}
	public function destroy(string $id)
	{
		$blog = Post::find($id);
		$blog->delete();
		return redirect()->route('post.index')->with('success', 'Dữ liệu đã được xóa');
	}

	public function showByCategory($categoryId)
	{
		$category = Category::findOrFail($categoryId);
		$posts = $category->posts()->where('status', 'approved')->paginate(10);

		return view('client.search', compact('posts', 'category'));
	}
	public function detail($id)
	{
			$post = Post::findOrFail($id);
			$comments = $post->comments();
			// Lấy danh sách tất cả các danh mục của các bài viết
			$categories = $post->categories()->pluck('categories.id');

			// Lấy các bài viết liên quan theo danh mục
			$relatedPosts = Post::whereHas('categories', function ($query) use ($categories) {
					$query->whereIn('categories.id', $categories);
			})
					->where('id', '!=', $id)
					->orderBy('created_at', 'desc')
					->where('status', 'approved')
					->limit(6)
					->get();

			return view('client.post.detail', compact('post', 'comments', 'relatedPosts'));
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
