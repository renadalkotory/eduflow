<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Courses - EduFlow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">
</head>
<body>

{{-- Nav bar --}}
<nav class="navbar navbar-expand-lg sticky-top glass-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">EduFlow</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('browse.courses') }}">Browse Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}#categories">Categories</a>
        </li>
        <li class="nav-item">
        </li>
      </ul>
      <div class="d-flex align-items-center gap-3">
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

{{-- Page header --}}
<section class="browse-header py-5">
  <div class="container">
    <p class="breadcrumb-text mb-2">
      <span class="text-primary fw-semibold">CATALOG</span> <i class="bi bi-chevron-right small mx-1"></i> ALL COURSES
    </p>
    <h1 class="browse-title mb-3">Expand Your Horizons</h1>
    <p class="text-muted browse-subtitle">
      Discover a curated collection of expert-led courses designed for deep work and skill acquisition.
    </p>
  </div>
</section>

{{-- Search + filters --}}
<section class="container mb-5">
  <div class="d-flex flex-wrap gap-2">
    <div class="search-bar-wrap flex-grow-1">
      <i class="bi bi-search"></i>
      <input type="text" class="form-control search-input" placeholder="Search for courses, skills, or instructors...">
    </div>

    <div class="dropdown">
      <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="bi bi-grid me-1"></i> Category
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Technology</a></li>
        <li><a class="dropdown-item" href="#">Business</a></li>
        <li><a class="dropdown-item" href="#">Arts &amp; Design</a></li>
        <li><a class="dropdown-item" href="#">Language</a></li>
      </ul>
    </div>

    <div class="dropdown">
      <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="bi bi-credit-card me-1"></i> Price Range
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Under $50</a></li>
        <li><a class="dropdown-item" href="#">$50 - $100</a></li>
        <li><a class="dropdown-item" href="#">$100+</a></li>
      </ul>
    </div>

    <div class="dropdown">
      <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="bi bi-star me-1"></i> Rating
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">4.5 &amp; up</a></li>
        <li><a class="dropdown-item" href="#">4.0 &amp; up</a></li>
        <li><a class="dropdown-item" href="#">3.5 &amp; up</a></li>
      </ul>
    </div>
  </div>
</section>

{{-- Course grid --}}
<section class="container mb-5">
  <div class="row g-4">

    @forelse ($courses as $course)
    <div class="col-md-6 col-lg-3">
      <div class="course-card h-100">
        <div class="course-img-wrap">
          <span class="course-tag">{{ $course->category->name ?? 'General' }}</span>
          <img src="{{ $course->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80' }}" alt="{{ $course->title }}">
        </div>
        <div class="course-body">
          <p class="text-muted small mb-2">Course #{{ $course->course_id }}</p>
          <h6 class="fw-bold mb-1">{{ $course->title }}</h6>
          <p class="text-muted small mb-3">{{ Str::limit($course->description, 70) }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-6">{{ $course->price > 0 ? '$' . number_format($course->price, 2) : 'Free' }}</span>
          </div>
          @auth
            <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
              @csrf
              <input type="hidden" name="course_id" value="{{ $course->course_id }}">
              <input type="hidden" name="title" value="{{ $course->title }}">
              <input type="hidden" name="category" value="{{ $course->category->name ?? 'General' }}">
              <input type="hidden" name="duration" value="N/A">
              <input type="hidden" name="price" value="{{ $course->price }}">
              <input type="hidden" name="image" value="{{ $course->thumbnail ?? '' }}">
              <button type="submit" class="btn btn-primary btn-sm w-100">Add to Cart</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm w-100 mt-3">Login to Add to Cart</a>
          @endauth
        </div>
      </div>
    </div>
    @empty
      <p class="text-muted">No courses available yet.</p>
    @endforelse

  </div>
</section>

{{-- Pagination --}}
<section class="container mb-5 pb-5">
  <nav aria-label="Course pagination">
    <ul class="pagination justify-content-center gap-1">
      <li class="page-item disabled">
        <a class="page-link pagination-link" href="#"><i class="bi bi-arrow-left me-1"></i> Previous</a>
      </li>
      <li class="page-item"><a class="page-link pagination-link active" href="#">1</a></li>
      <li class="page-item"><a class="page-link pagination-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link pagination-link" href="#">3</a></li>
      <li class="page-item disabled"><span class="page-link pagination-link border-0">...</span></li>
      <li class="page-item"><a class="page-link pagination-link" href="#">12</a></li>
      <li class="page-item">
        <a class="page-link pagination-link" href="#">Next <i class="bi bi-arrow-right ms-1"></i></a>
      </li>
    </ul>
  </nav>
</section>

{{-- Footer --}}
<footer class="footer-section pt-5 pb-4">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-primary" href="{{ route('home') }}">
            <i class="bi bi-mortarboard-fill me-1"></i>EduFlow
        </a>
        <p class="text-muted small mt-2 mb-0">
            Empowering lifelong learners through expert-led courses.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>