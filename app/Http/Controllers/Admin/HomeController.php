<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
		public function index(Request $request){
			$timeRange = $request->input('time_range', 'today'); // Gán mặc định là 'today' nếu không có giá trị
        $startDate = null;
        $endDate = Carbon::now();
        $quantityData = 5;
        if ($timeRange === 'today') {
            $startDate = Carbon::today();
        } elseif ($timeRange === 'last_week') {
            $startDate = Carbon::now()->subWeek();
        } elseif ($timeRange === 'two_weeks_ago') {
            $startDate = Carbon::now()->subWeeks(2);
        }
        $approvedCount = Post::where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $pendingCount = Post::where('status', 'pending')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $user_joined_count = User::where('created_at', '>=', $startDate)->count();
        $comment_count = Comment::where('created_at', '>=', $startDate)->count();
        $users_top =  User::withCount('posts')
        ->orderBy('posts_count', 'desc')
        ->paginate($quantityData);
        return view('admin.dashboard', compact('approvedCount', 'pendingCount', 'timeRange', 'user_joined_count', 'comment_count', 'users_top','quantityData'));
		}
}
