@foreach($children as $child)
<li class="
      @if(count($child->allChildren))
      dropdown
      @endif
      ">
    <a class="dropdown-item 
          @if(count($child->allChildren))
          dropdown-toggle
          @endif
          " href="{{ route('post.showByCategory', ['categoryId' => $child->id]) }}"
        id="submenu-{{ $child->id }}">
        {{ $child->name }}
    </a>
    @if(count($child->allChildren))
    <ul class="dropdown-menu dropdown-menu-dark">
        @foreach($child->allChildren as $subChild)
        <li class=""><a class="dropdown-item"
                href="{{ route('post.showByCategory', ['categoryId' => $subChild->id]) }}">{{
                $subChild->name }}</a>
            @if(count($subChild->allChildren))
            <ul class="dropdown-menu dropdown-menu-dark">
                @include('client.components.submenu', ['children' => $subChild->allChildren])
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
    @endif
</li>
@endforeach