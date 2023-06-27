<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	//
	public function index()
	{
		$user = Auth::user();
		//check role
		if ($user->role == 0) {
			return view('admin.profile.index', compact('user'));
		}
		// Lấy thông tin cụ thể của người dùng đã đăng nhập
		return view('client.profile.index', compact('user'));
	}

	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$request->validate([
			'name' => 'required',
		]);
		$user->name = $request->name;
		if ($request->hasFile('avatar')) {
			$request->validate([
				'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);
			if ($user->avatar != null && file_exists(public_path('uploads/' . $user->avatar))) {
				unlink(public_path('uploads/' . $user->avatar));
			}
			$avatar = $request->file('avatar');
			$newName = time() . "." . $avatar->getClientOriginalExtension();
			$avatar->move(public_path('uploads'), $newName);
			$user->avatar = $newName;
		}
		$user->save();
		session()->flash('success', 'Dữ liệu đã được sửa thành công.');
		return redirect()->back();
	}
}
