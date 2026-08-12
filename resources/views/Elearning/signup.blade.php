<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EduFlow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">
</head>
<body class="login-page">

<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100">
    <div class="login-card">

        <div class="text-center mb-3">
            <div class="login-logo mx-auto mb-3">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h4 class="fw-bold mb-1">Join EduFlow</h4>
            <p class="text-muted small mb-0">Begin your journey of academic excellence.</p>
        </div>

        <form method="POST" action="{{ route('signup.submit') }}">
            @csrf
            <input type="hidden" name="role" id="roleInput" value="student">

            <div class="mb-3">
                <label for="fullname" class="form-label small fw-semibold">FULL NAME</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-person"></i>
                    <input type="text" name="fullname" id="fullname" class="form-control ps-5" placeholder="Dr. Jane Doe" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold">INSTITUTIONAL EMAIL</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control ps-5" placeholder="jane.doe@university.edu" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small fw-semibold">SECURE PASSWORD</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" id="password" class="form-control ps-5 pe-5" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </button>
                </div>
                <div class="password-strength mt-2 d-flex gap-1">
                    <div class="strength-bar" id="bar1"></div>
                    <div class="strength-bar" id="bar2"></div>
                    <div class="strength-bar" id="bar3"></div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold">SELECT PRIMARY ROLE</label>
                <div class="row g-2" id="roleCards">
                    <div class="col-4">
                        <div class="role-card active" data-role="student">
                            <i class="bi bi-mortarboard"></i>
                            <span>Student</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="role-card" data-role="instructor">
                            <i class="bi bi-person-badge"></i>
                            <span>Instructor</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="role-card" data-role="admin">
                            <i class="bi bi-shield-lock"></i>
                            <span>Admin</span>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2">
                Create Account <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>

        <hr class="my-4">

        <p class="text-center small text-muted mb-0">
            Already part of the academy?
            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">Access Portal</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>