<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;
	protected $table = 'posts';

	protected $fillable = ['title', 'content', 'short_content', 'user_id', 'category_id', 'thumbnail', 'is_featured'];

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id');
	}
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
