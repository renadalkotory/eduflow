<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - EduFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top glass-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">EduFlow</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('browse.courses') }}">Browse Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('categories') }}">Categories</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <button class="theme-toggle-btn" id="themeToggleBtn" type="button" title="Toggle dark mode">
          <i class="bi bi-moon-fill" id="themeIcon"></i>
        </button>
        <button class="theme-toggle-btn" id="themeToggleBtn" type="button" title="Toggle dark mode">
          <i class="bi bi-moon-fill" id="themeIcon"></i>
        </button>
        @auth
          <form method="POST" action="{{ route('logout') }}" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
          </form>
        @else
          <a class="nav-link loginlink" href="{{ route('login') }}">Login</a>
          <a class="btn btn-primary" href="{{ route('signup') }}">Sign Up</a>
        @endauth
      </div>
    </div>
  </div>
</nav>

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show container mt-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<section class="categories-section py-5">
  <div class="container py-4">
    <div class="text-center mb-5">
      <h1 class="section-title">Explore All Categories</h1>
      <p class="text-muted">Find the perfect subject to advance your career.</p>
    </div>

    <div class="row g-4">
      @forelse ($categories as $category)
        <div class="col-6 col-lg-3">
          <a href="{{ route('browse.courses', ['category_id' => $category->category_id]) }}" class="text-decoration-none text-dark">
            <div class="category-card text-center h-100">
              <div class="category-icon bg-icon-blue"><i class="bi bi-mortarboard-fill"></i></div>
              <h5 class="fw-bold mb-1">{{ $category->category_name }}</h5>
              <p class="text-muted small mb-0">{{ $category->courses_count }} Courses</p>
            </div>
          </a>
        </div>
      @empty
        <p class="text-muted text-center">No categories yet.</p>
      @endforelse
    </div>
  </div>
</section>

<footer class="footer-section pt-5 pb-4">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-primary" href="{{ route('home') }}">
            <i class="bi bi-mortarboard-fill me-1"></i>EduFlow
        </a>
        <p class="text-muted small mt-2 mb-0">Empowering lifelong learners through expert-led courses.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
