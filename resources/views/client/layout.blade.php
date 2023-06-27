<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <!-- Favicon-->
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
    crossorigin="anonymous">
  <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
  <script src="https://kit.fontawesome.com/86807bc2b2.js" crossorigin="anonymous"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link href="{{ asset('css/dropdown_hover.css') }}" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
    }
    /* CSS */
    .image img {
      width: 100%;
      height: auto;
    }

  </style>
</head>

<body>
  <!-- Page header with logo and tagline-->
  <header class="py-5 bg-light border-bottom">
    <div class="container">
      <div class="">
        <h2>Blog</h2>
      </div>
    </div>
  </header>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
              href="{{ route('home') }}">Trang chủ</a></li>
          {{-- dropdown --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Danh mục
            </a>
						<ul class="dropdown-menu dropdown-menu-dark">
              @foreach($menus as $menu)
              <li class="nav-item 
              @if(count($menu->allChildren))
              dropdown
              @endif
              ">
                <a class="nav-link 
              @if(count($menu->allChildren))
              dropdown-toggle
              @endif
              {{ request()->routeIs('post.showByCategory', ['categoryId' => $menu->id]) ? 'active' : '' }}"
                  href="{{ route('post.showByCategory', ['categoryId' => $menu->id]) }}">
                  {{ $menu->name }}
                </a>
                @if(count($menu->allChildren))
                <ul class="dropdown-menu dropdown-menu-dark">

                  @include('client.components.submenu', ['children' => $menu->allChildren])
                </ul>
                @endif
              </li>
              @endforeach
            </ul>
          </li>
					@if (Auth::check())

          <li class="nav-item"><a
              class="nav-link {{ request()->routeIs('post.index') ? 'active' : '' }}"
              href="{{ route('post.index') }}">Bài viết</a></li>
          <li class="nav-item"><a
              class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}"
              href="{{ route('profile.index') }}">Thông tin</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a></li>

          @if (Auth::user()->role == 0)
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Trang Admin</a>
          </li>
          @endif
          @else
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
              href="{{ route('login') }}">Đăng nhập</a></li>
          <li class="nav-item"><a
              class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
              href="{{ route('register') }}">Đăng Ký</a></li>
          @endif
        </ul>
      </div>
    </div>

  </nav>

  <div class="container">
    <div class="row">
      <!-- Blog entries-->
      <div
        class="@if(request()->is('post*') || request()->is('login') || request()->is('register') || request()->is('profile*')) col-lg-12 @else col-lg-8 @endif">
        @yield('content')
      </div>
      <div
        class="col-lg-4 @if(request()->is('post*') || request()->is('login') || request()->is('register')|| request()->is('profile*')) d-none @endif">
        @include('client.components.side_widgets', ['categories' => $categories])
      </div>
    </div>
  </div>
  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">

  </script>
  @yield('js-custom')

</body>

</html>