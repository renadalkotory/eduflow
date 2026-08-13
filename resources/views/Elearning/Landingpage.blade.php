<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduFlow - Master New Skills Today</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  
</head>
<body>

{{-- Nav bar--}}
<nav class="navbar navbar-expand-lg sticky-top glass-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="#">EduFlow</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('browse.courses') }}">Browse Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
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

<section class="hero-section py-5">
  <div class="container">
    <div class="row align-items-center gy-5">

      <!--LEFT -->
      <div class="col-lg-6">
        <span class="badge-pill">
          <i class="bi bi-stars me-1"></i> NEW COURSES ADDED DAILY
        </span>
        <h1 class="hero-title mt-3">
          Master New Skills <br>
          <span class="text-primary">Today.</span>
        </h1>
        <p class="hero-subtitle">
          Unlock your potential with expert-led courses designed for flexible,
          lifelong learning. Elevate your career or discover a new passion
          from anywhere in the world.
        </p>
        <div class="d-flex gap-3 mb-4">
          <a href="#" class="btn btn-primary btn-lg px-4">Get Started <i class="bi bi-arrow-right ms-1"></i></a>
          <a href="#" class="btn btn-light btn-lg px-4 border">Watch Demo</a>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="col-lg-6">
        <div class="row g-3">

          <div class="col-7">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500&q=80"
                 class="img-fluid rounded-4 w-100 h-100 object-fit-cover hero-img-tall">
          </div>

          <div class="col-5 d-flex flex-column gap-3">
            <img src="https://images.unsplash.com/photo-1587440871875-191322ee64b0?w=300&q=80"
                 class="img-fluid rounded-4 w-100 hero-img-short">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=300&q=80"
                 class="img-fluid rounded-4 w-100 hero-img-short">
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


<!-- categories -->
<section id="categories" class="categories-section py-5">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-2">
      <div>
        <h2 class="section-title">Explore Top Categories</h2>
        <p class="text-muted mb-0">Find the perfect subject to advance your career.</p>
      </div>
      <a href="{{ route('browse.courses') }}" class="text-primary fw-semibold text-decoration-none">
        See All Categories <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="row g-4">
      <div class="col-6 col-lg-3">
        <div class="category-card text-center h-100">
          <div class="category-icon bg-icon-blue"><i class="bi bi-code-slash"></i></div>
          <h5 class="fw-bold mb-1">Technology</h5>
          <p class="text-muted small mb-0">120+ Courses</p>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="category-card text-center h-100">
          <div class="category-icon bg-icon-purple"><i class="bi bi-graph-up-arrow"></i></div>
          <h5 class="fw-bold mb-1">Business</h5>
          <p class="text-muted small mb-0">85+ Courses</p>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="category-card text-center h-100">
          <div class="category-icon bg-icon-green"><i class="bi bi-palette-fill"></i></div>
          <h5 class="fw-bold mb-1">Arts &amp; Design</h5>
          <p class="text-muted small mb-0">60+ Courses</p>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="category-card text-center h-100">
          <div class="category-icon bg-icon-gray"><i class="bi bi-translate"></i></div>
          <h5 class="fw-bold mb-1">Language</h5>
          <p class="text-muted small mb-0">45+ Courses</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- trending course s=-->
<section id="courses" class="courses-section py-5">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
      <div>
        <p class="eyebrow mb-1"><span></span> FEATURED</p>
        <h2 class="section-title mb-0">Trending Courses</h2>
      </div>
      <div class="d-flex gap-2">
        <button class="nav-arrow" id="prevCourse"><i class="bi bi-chevron-left"></i></button>
        <button class="nav-arrow" id="nextCourse"><i class="bi bi-chevron-right"></i></button>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="course-card h-100">
          <div class="course-img-wrap">
            <span class="course-tag">DEVELOPMENT</span>
            <button class="wishlist-btn"><i class="bi bi-heart"></i></button>
            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=500&q=80" alt="Complete Web Development">
          </div>
          <div class="course-body">
            <div class="d-flex align-items-center gap-1 mb-2 small">
              <i class="bi bi-star-fill text-warning"></i>
              <span class="fw-semibold">4.8</span>
              <span class="text-muted">(1,245)</span>
            </div>
            <h6 class="fw-bold mb-1">Complete Web Development...</h6>
            <p class="text-muted small mb-3">Dr. Angela Yu</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold fs-6">$89.99</span>
              <a href="#" class="text-primary small fw-semibold text-decoration-none">View Course</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="course-card h-100">
          <div class="course-img-wrap">
            <span class="course-tag">MARKETING</span>
            <button class="wishlist-btn"><i class="bi bi-heart"></i></button>
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&q=80" alt="Digital Marketing Masterclass">
          </div>
          <div class="course-body">
            <div class="d-flex align-items-center gap-1 mb-2 small">
              <i class="bi bi-star-fill text-warning"></i>
              <span class="fw-semibold">4.7</span>
              <span class="text-muted">(892)</span>
            </div>
            <h6 class="fw-bold mb-1">Digital Marketing Masterclass 2024</h6>
            <p class="text-muted small mb-3">Evan Kim</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold fs-6">$64.99</span>
              <a href="#" class="text-primary small fw-semibold text-decoration-none">View Course</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="course-card h-100">
          <div class="course-img-wrap">
            <span class="course-tag">DATA SCIENCE</span>
            <button class="wishlist-btn"><i class="bi bi-heart"></i></button>
            <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=500&q=80" alt="Python for Data Science">
          </div>
          <div class="course-body">
            <div class="d-flex align-items-center gap-1 mb-2 small">
              <i class="bi bi-star-fill text-warning"></i>
              <span class="fw-semibold">4.9</span>
              <span class="text-muted">(3,102)</span>
            </div>
            <h6 class="fw-bold mb-1">Python for Data Science and...</h6>
            <p class="text-muted small mb-3">Jose Portilla</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold fs-6">$99.99</span>
              <a href="#" class="text-primary small fw-semibold text-decoration-none">View Course</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="course-card h-100">
          <div class="course-img-wrap">
            <span class="course-tag">DESIGN</span>
            <button class="wishlist-btn"><i class="bi bi-heart"></i></button>
            <img src="https://images.unsplash.com/photo-1487014679447-9f8336841d58?w=500&q=80" alt="Graphic Design Bootcamp">
          </div>
          <div class="course-body">
            <div class="d-flex align-items-center gap-1 mb-2 small">
              <i class="bi bi-star-fill text-warning"></i>
              <span class="fw-semibold">4.6</span>
              <span class="text-muted">(541)</span>
            </div>
            <h6 class="fw-bold mb-1">Graphic Design Bootcamp: Part 1</h6>
            <p class="text-muted small mb-3">Derrick Mitchell</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold fs-6">$49.99</span>
              <a href="#" class="text-primary small fw-semibold text-decoration-none">View Course</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- news letter -->
<section class="newsletter-section">
    <div class="container text-center text-white py-5">
        <h2 class="fw-bold display-6 mb-3">Join our learning community</h2>
        <p class="mb-4 mx-auto" style="max-width:600px; opacity:.9;">
            Subscribe to our newsletter for the latest course updates, exclusive
            discounts, and learning tips directly to your inbox.
        </p>
        <form class="d-flex justify-content-center gap-2 flex-wrap" action="#" method="POST">
            <input type="email" name="email" class="form-control newsletter-input" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-purple-custom px-4">Subscribe</button>
        </form>
    </div>
    <div class="wave-shape"></div>
</section>

<!--footer -->
<footer class="footer-section pt-5 pb-4">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-primary" href="#">
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