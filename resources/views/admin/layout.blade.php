<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>@yield('title')</title>
  <!-- Favicon-->
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
    crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
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
    @yield('css-custom')
    
    
</head>
<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Admin</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class=" d-flex text-white align-items-center">
      <div class="">
        <a class="nav-link px-3" href="{{ route('admin.profile') }}">
          @if (Auth::user()->avatar)
            <img src="{{ asset('uploads/'.Auth::user()->avatar) }}" alt="" class="rounded-circle" width="40" height="40">
          @else
            <img src="{{ asset('uploads/OIP.jfif') }}" alt="" class="rounded-circle" width="40" height="40">
          @endif
          {{ Auth::user()->name }}
        </a>
      </div>
      <div class="">
        <a class="nav-link px-3" href="{{ route('logout') }}">Đăng xuất</a>
      </div>
    </div>
  </header>
  
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}" href="{{ route('category.index') }}">
                <span data-feather="file"></span>
                Danh mục
              </a>
             
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link {{ Request::is('admin/post*') ? 'active' : '' }}" href="{{ route('admin.post.index') }}">
                <span data-feather="file"></span>
                Bài viết
              </a>
             
            </li>
            <li class="nav-item">
              <a class="nav-link {{Request::is('admin/browse') ? 'active' : ''}}" href="{{ route('admin.browse')}}">
                <span data-feather="file"></span>
                Duyệt bài
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/comment*') ? 'active' : '' }}" href="{{ route('comment.index') }} ">
                <span data-feather="users"></span>
                Bình luận
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }} ">
                <span data-feather="users"></span>
                Thành viên
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }} ">
                <span data-feather="users"></span>
                Trang người dùng
              </a>
            </li>
            
          </ul>
        </div>
      </nav>
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">@yield('header_title')</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              
            <button type="submit" class="btn btn-sm btn-outline-secondary">Import</button>
              <button class="btn btn-sm btn-outline-secondary">export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>
  
        @yield('content')
     
      </main>
    </div>
  </div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
</script>
@yield('js-custom')

</body>

</html>