<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $users = User::latest()->paginate(5);
        }
        return view('admin.user.index', compact('users'));
    }
}