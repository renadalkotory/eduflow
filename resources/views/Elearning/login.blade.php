<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduFlow</title>

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
            <h4 class="fw-bold mb-1">Welcome Back</h4>
            <p class="text-muted small mb-0">Sign in to continue your learning journey.</p>
        </div>

        <!-- Role tabs -->
        <div class="role-tabs d-flex mb-4" id="roleTabs">
            <button type="button" class="role-tab active" data-role="student">Student</button>
            <button type="button" class="role-tab" data-role="instructor">Instructor</button>
            <button type="button" class="role-tab" data-role="admin">Admin</button>
        </div>
<form method="POST" action="{{ route('login.submit') }}">
            @csrf

   
            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    {{ $errors->first() }}
                </div>
            @endif
            <input type="hidden" name="role" id="roleInput" value="student">

            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold">EMAIL OR USERNAME</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="text" name="email" id="email" class="form-control ps-5" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label small fw-semibold">PASSWORD</label>
                    <a href="#" class="small text-primary text-decoration-none">Forgot Password?</a>
                </div>
                <div class="input-icon-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" id="password" class="form-control ps-5 pe-5" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2 mt-2">
                Sign In <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>

        <div class="divider-text my-4">
            <span>OR CONTINUE WITH</span>
        </div>

        <div class="d-flex gap-2">
            <a href="#" class="btn btn-social w-50">
                <i class="bi bi-google me-1"></i> Google
            </a>
            <a href="#" class="btn btn-social w-50">
                <i class="bi bi-linkedin me-1"></i> LinkedIn
            </a>
        </div>

        <p class="text-center small text-muted mt-4 mb-0">
            Don't have an account?
            <a href="{{ route('signup') }}" class="text-primary fw-semibold text-decoration-none">Sign up here</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>