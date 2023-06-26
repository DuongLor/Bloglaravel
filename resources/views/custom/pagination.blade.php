<nav aria-label="Pagination">
  <ul class="pagination justify-content-center my-4">
    @if ($paginator->onFirstPage())
    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
        aria-disabled="true">&laquo;</a></li>
    @else
    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"
        rel="prev">&laquo;</a></li>
    @endif

    <!-- Hiển thị các liên kết tới các trang -->
    @foreach ($elements as $element)
    <!-- Hiển thị liên kết tới trang hiện tại -->
    @if (is_string($element))
    <li class="disabled"><span>{{ $element }}</span></li>
    <li class="page-item disabled"><a class="page-link" href="#">{{ $element }}</a></li>
    @endif
    <!-- Hiển thị liên kết tới các trang khác -->
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a>
    </li>
    @else
    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    <!-- Hiển thị các liên kết trang trước và sau -->
    @if ($paginator->hasMorePages())
    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"
        rel="next">&raquo;</a></li>
    @else
    <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
    @endif


  </ul>
</nav>