<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6fb; }
        .instructor-topnav {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
        }
        .instructor-topnav .nav-link-item {
            color: #495057;
            font-weight: 500;
            font-size: .9rem;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
        }
        .instructor-topnav .nav-link-item:hover { background: #f1f5f9; }
        .instructor-topnav .nav-link-item.active { background: #dbe6fe; color: #1A56DB; font-weight: 600; }
        .form-card, .side-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: 0 4px 14px rgba(0,0,0,.04);
            margin-bottom: 1.5rem;
        }
        .upload-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px dashed #d0d7e6;
            border-radius: 14px;
            padding: 2rem;
            cursor: pointer;
            text-align: center;
            color: #697386;
        }
        .upload-box:hover { border-color: #1A56DB; background: #f8faff; }
        .preview-image {
            max-width: 100%;
            border-radius: 12px;
            margin-top: 1rem;
            display: none;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: .9rem;
        }
        .summary-row:last-child { border-bottom: none; }
    </style>
</head>
<body>

<nav class="instructor-topnav px-4 py-3 d-flex flex-wrap align-items-center gap-2">
    <a href="{{ route('home') }}" class="fw-bold text-primary fs-5 text-decoration-none me-4">EduFlow</a>

    <a href="{{ route('instructor.dashboard') }}" class="nav-link-item">
        <i class="bi bi-arrow-left me-1"></i> Dashboard
    </a>
    <a class="nav-link-item {{ request()->routeIs('instructor.createCourse') ? 'active' : '' }}" href="{{ route('instructor.createCourse') }}">Create Course</a>
    <a class="nav-link-item {{ request()->routeIs('instructor.manageCourse') ? 'active' : '' }}" href="{{ route('instructor.manageCourse') }}">Manage Course</a>
    <a class="nav-link-item {{ request()->routeIs('instructor.createQuiz') ? 'active' : '' }}" href="{{ route('instructor.createQuiz') }}">Create Quiz</a>
    <a class="nav-link-item {{ request()->routeIs('instructor.gradeTests') ? 'active' : '' }}" href="{{ route('instructor.gradeTests') }}">Grade Tests</a>
    <a class="nav-link-item {{ request()->routeIs('instructor.students') ? 'active' : '' }}" href="{{ route('instructor.students') }}">Students</a>
    <a class="nav-link-item {{ request()->routeIs('instructor.profile') ? 'active' : '' }}" href="{{ route('instructor.profile') }}">Profile</a>
</nav>

<main class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold">Create Course</h1>
        <p class="text-muted">Create and organize your new course.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
        @csrf

        <div class="row g-4">

            <!-- Left side -->
            <div class="col-lg-8">

                <div class="form-card">
                    <h2 class="fs-5 fw-bold mb-3">Course Information</h2>

                    <div class="mb-3">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="title" id="courseTitle" class="form-control" placeholder="Enter course title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course Description</label>
                        <textarea name="description" id="courseDescription" class="form-control" rows="6" placeholder="Describe what students will learn in this course" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_id" id="courseCategory" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Level <span class="text-muted small">(display only, not saved yet)</span></label>
                            <select id="courseLevel" class="form-select">
                                <option value="">Select Level</option>
                                <option>Beginner</option>
                                <option>Intermediate</option>
                                <option>Advanced</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Course Price ($)</label>
                            <input type="number" name="price" id="coursePrice" class="form-control" step="0.01" min="0" placeholder="0.00" value="{{ old('price') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estimated Duration <span class="text-muted small">(display only, not saved yet)</span></label>
                            <input type="text" id="courseDuration" class="form-control" placeholder="Example: 12 hours">
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <h2 class="fs-5 fw-bold mb-3">Course Thumbnail</h2>

                    <label for="courseImage" class="upload-box">
                        <i class="bi bi-cloud-arrow-up fs-2 mb-2"></i>
                        <strong>Upload Course Image</strong>
                        <p class="mb-0 small">PNG, JPG or JPEG — Recommended: 1280×720</p>
                    </label>
                    <input type="file" name="thumbnail" id="courseImage" accept="image/png,image/jpeg" hidden>
                    <img id="previewImage" class="preview-image" alt="Course preview">
                </div>
            </div>

            <!-- Right side -->
            <div class="col-lg-4">

                <div class="side-card">
                    <h3 class="fs-6 fw-bold mb-3">Course Summary</h3>
                    <div class="summary-row"><span>Title</span><strong id="summaryTitle">—</strong></div>
                    <div class="summary-row"><span>Category</span><strong id="summaryCategory">—</strong></div>
                    <div class="summary-row"><span>Level</span><strong id="summaryLevel">—</strong></div>
                    <div class="summary-row"><span>Price</span><strong id="summaryPrice">$0</strong></div>
                    <div class="summary-row"><span>Duration</span><strong id="summaryDuration">—</strong></div>
                </div>

                <div class="side-card">
                    <h3 class="fs-6 fw-bold mb-3">Course Status</h3>
                    <label class="form-label">Status</label>
                    <select name="status" id="courseStatus" class="form-select">
                        <option value="Draft">Draft</option>
                        <option value="Published">Published</option>
                    </select>
                    <p class="text-muted small mt-2 mb-0">Save as draft if you want to continue editing the course later.</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-2 mb-5">
            <a href="{{ route('instructor.dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create Course</button>
        </div>
    </form>
</main>

<footer class="footer-section pt-5 pb-4">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-primary" href="{{ route('home') }}">
            <i class="bi bi-mortarboard-fill me-1"></i>EduFlow
        </a>
        <p class="text-muted small mt-2 mb-0">Empowering lifelong learners through expert-led courses.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Live preview only — does not affect what gets saved
    const titleInput = document.getElementById('courseTitle');
    const categorySelect = document.getElementById('courseCategory');
    const levelSelect = document.getElementById('courseLevel');
    const priceInput = document.getElementById('coursePrice');
    const durationInput = document.getElementById('courseDuration');

    titleInput.addEventListener('input', () => {
        document.getElementById('summaryTitle').textContent = titleInput.value || '—';
    });
    categorySelect.addEventListener('change', () => {
        const text = categorySelect.options[categorySelect.selectedIndex]?.text || '—';
        document.getElementById('summaryCategory').textContent = categorySelect.value ? text : '—';
    });
    levelSelect.addEventListener('change', () => {
        document.getElementById('summaryLevel').textContent = levelSelect.value || '—';
    });
    priceInput.addEventListener('input', () => {
        document.getElementById('summaryPrice').textContent = '$' + (parseFloat(priceInput.value) || 0).toFixed(2);
    });
    durationInput.addEventListener('input', () => {
        document.getElementById('summaryDuration').textContent = durationInput.value || '—';
    });

    // Image preview
    const courseImage = document.getElementById('courseImage');
    const previewImage = document.getElementById('previewImage');
    courseImage.addEventListener('change', () => {
        const file = courseImage.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewImage.style.display = 'block';
        }
    });
</script>
</body>
</html>