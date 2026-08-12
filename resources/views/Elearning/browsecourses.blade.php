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
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <a class="nav-link loginlink" href="{{ route('login') }}">Login</a>
        <a class="btn btn-primary" href="{{ route('signup') }}">Sign Up</a>
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

    <div class="col-md-6 col-lg-3">
      <div class="course-card h-100">
        <div class="course-img-wrap">
          <span class="course-tag">DESIGN</span>
          <img src="https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=500&q=80" alt="Advanced System Architecture">
        </div>
        <div class="course-body">
          <div class="d-flex align-items-center gap-1 mb-2 small text-muted">
            <i class="bi bi-clock"></i> 12h 45m
            <span class="mx-1">·</span>
            <i class="bi bi-star-fill text-warning"></i> <span class="fw-semibold text-dark">4.8</span> (1.2k)
          </div>
          <h6 class="fw-bold mb-1">Advanced System Architecture...</h6>
          <p class="text-muted small mb-3">Master the principles of scalable and resilient syste...</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <img src="https://randomuser.me/api/portraits/women/44.jpg" class="instructor-avatar" alt="Dr. A. Chen">
              <span class="small fw-semibold">Dr. A. Chen</span>
            </div>
            <span class="fw-bold fs-6">$89</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="course-card h-100">
        <div class="course-img-wrap">
          <span class="course-tag">DATA SCIENCE</span>
          <img src="https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=500&q=80" alt="Applied Machine Learning">
        </div>
        <div class="course-body">
          <div class="d-flex align-items-center gap-1 mb-2 small text-muted">
            <i class="bi bi-clock"></i> 24h 10m
            <span class="mx-1">·</span>
            <i class="bi bi-star-fill text-warning"></i> <span class="fw-semibold text-dark">4.9</span> (3.4k)
          </div>
          <h6 class="fw-bold mb-1">Applied Machine Learning...</h6>
          <p class="text-muted small mb-3">Build and deploy your first predictive models using...</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <img src="https://randomuser.me/api/portraits/men/32.jpg" class="instructor-avatar" alt="M. Silva">
              <span class="small fw-semibold">M. Silva</span>
            </div>
            <span class="fw-bold fs-6">$120</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="course-card h-100">
        <div class="course-img-wrap">
          <span class="course-tag">DEVELOPMENT</span>
          <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&q=80" alt="Modern Frontend Workflows">
        </div>
        <div class="course-body">
          <div class="d-flex align-items-center gap-1 mb-2 small text-muted">
            <i class="bi bi-clock"></i> 8h 30m
            <span class="mx-1">·</span>
            <i class="bi bi-star-fill text-warning"></i> <span class="fw-semibold text-dark">4.6</span> (850)
          </div>
          <h6 class="fw-bold mb-1">Modern Frontend Workflows</h6>
          <p class="text-muted small mb-3">Optimize your development process with modern toolin...</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <span class="instructor-avatar-fallback">J</span>
              <span class="small fw-semibold">J. Davis</span>
            </div>
            <span class="fw-bold fs-6">$49</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="course-card h-100">
        <div class="course-img-wrap">
          <span class="course-tag">BUSINESS</span>
          <img src="https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=500&q=80" alt="Strategic Leadership in Tech">
        </div>
        <div class="course-body">
          <div class="d-flex align-items-center gap-1 mb-2 small text-muted">
            <i class="bi bi-clock"></i> 15h 00m
            <span class="mx-1">·</span>
            <i class="bi bi-star-fill text-warning"></i> <span class="fw-semibold text-dark">4.7</span> (2.1k)
          </div>
          <h6 class="fw-bold mb-1">Strategic Leadership in Tech</h6>
          <p class="text-muted small mb-3">Develop the frameworks needed to lead engineering...</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <img src="https://randomuser.me/api/portraits/women/68.jpg" class="instructor-avatar" alt="S. Williams">
              <span class="small fw-semibold">S. Williams</span>
            </div>
            <span class="fw-bold fs-6">$150</span>
          </div>
        </div>
      </div>
    </div>

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