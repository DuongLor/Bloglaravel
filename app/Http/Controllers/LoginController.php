<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
		public function login()
    {
        return view('client.login');
    }
		public function store(Request $request)
		{
			$request->validate([
				'email' => 'required|email',
				'password' => 'required'
			]);
			$credentials = $request->only('email', 'password');
			if (Auth::attempt($credentials)) {
				// Kiểm tra xem người dùng đã xác thực email hay chưa
				if (Auth::user()->email_verified_at !== null) {
						// Người dùng đã xác thực và đăng nhập thành công
						return redirect()->route('home');
				} else {
						// Người dùng chưa xác thực email
						Auth::logout();
						return redirect()->back()->with('error', 'Vui lòng xác thực email trước khi đăng nhập.');
				}
		} else {
				// Đăng nhập thất bại
				return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác.');
		}
		}
		public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
