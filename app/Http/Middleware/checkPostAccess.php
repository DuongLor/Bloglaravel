<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkPostAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
			$postID = $request->route('post');
			$post = Post::find($postID);
			if(Auth::check()){
				$userID = Auth::user()->id;
				if($post->user_id == $userID){
					return $next($request);
				}
				else{
					// lỗi 403
					return abort(403, 'Bạn không có quyền truy cập');
				}
			}
    }
		private function checkPostAccess(){
			
		}
}
