<!-- _category.blade.php -->

<li>
	<div class="d-flex gap-3 mb-2"> <p>{{ $category->name }}</p>
	 <div class="d-flex gap-2 align-items-baseline">
			 <div>
				 <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">Sửa</a>
			 </div>
			 <form action="{{route('category.destroy',$category->id)}}" method="post">
				 @csrf
				 @method('DELETE')
				 {{-- button confirm --}}
				 <button class="btn btn-danger"
					 onclick="return confirm('Xác nhận xóa?')">Xóa</button>
			 </form>
		 </div>
	 </div>

	 @if ($category->children->count() > 0)
			 <ul>
					 @foreach ($category->children as $child)
							 @include('admin.category._category', ['category' => $child])
					 @endforeach
			 </ul>
	 @endif
</li>


