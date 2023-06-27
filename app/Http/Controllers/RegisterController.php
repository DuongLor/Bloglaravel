<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AuthMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
	//
	public function index()
	{
		return view('client.register');
	}
	public function store(Request $request)
	{
		$user = User::where('email', $request->email)->first();
		if ($user) {
			return  back()->with('error', 'Email đã được đăng ký');
		}
		$token = Str::random(60);
		$request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:1',
			'password_confirmation' => 'required|same:password',
		]);
		//create user
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'token' => $token,
		]);
		// send email
		Mail::to($user->email)->send(new AuthMail($token));
		echo "Cảm ơn bạn đã đăng ký, bây giờ hãy vào email để xác thực";
	}
	public function verify($token)
	{
		// verify token
		$user = User::where('token', $token)->first();
		if ($user) {
			$user->email_verified_at = now();
			$user->token = null;
			$user->save();
			return redirect()->route('login')->with('success', 'Xác thực thành công');
		}
		abort(404);
	}
}
