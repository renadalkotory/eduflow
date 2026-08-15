<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - EduFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top glass-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">EduFlow</a>
    <div class="d-flex align-items-center gap-3 ms-auto">
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

<section class="py-5">
  <div class="container">
    <p class="breadcrumb-text mb-3">
      <a href="{{ route('browse.courses') }}" class="text-primary text-decoration-none">Courses</a>
      <i class="bi bi-chevron-right small mx-1"></i> {{ $course->title }}
    </p>

    <div class="row g-5">
      <div class="col-lg-7">
        <img src="{{ $course->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80' }}"
             class="img-fluid rounded-4 mb-4 w-100" style="max-height:400px; object-fit:cover;">
        <span class="badge-pill mb-2">{{ $course->category->category_name ?? 'General' }}</span>
        <h1 class="hero-title mb-3" style="font-size:2rem;">{{ $course->title }}</h1>
        <p class="text-muted">{{ $course->description }}</p>
        <p class="text-muted small">
          Instructor: <strong>{{ $course->instructor->name ?? 'EduFlow Instructor' }}</strong>
        </p>
      </div>

      <div class="col-lg-5">
        <div class="course-card p-4">
          <h3 class="fw-bold mb-3">
            {{ $course->price > 0 ? '$' . number_format($course->price, 2) : 'Free' }}
          </h3>

          @auth
            <form action="{{ route('cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="course_id" value="{{ $course->course_id }}">
              <input type="hidden" name="title" value="{{ $course->title }}">
              <input type="hidden" name="category" value="{{ $course->category->category_name ?? 'General' }}">
              <input type="hidden" name="duration" value="N/A">
              <input type="hidden" name="price" value="{{ $course->price }}">
              <input type="hidden" name="image" value="{{ $course->thumbnail ?? '' }}">
              <button type="submit" class="btn btn-primary btn-lg w-100">Add to Cart</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg w-100">Login to Add to Cart</a>
          @endauth
        </div>
      </div>
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
