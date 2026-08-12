<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Instructor Profile</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Your CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/profile.css') }}"
    >
</head>

<body>

<div class="container py-5">

    <div class="mb-4">
        <h1>Instructor Profile</h1>
        <p class="text-muted">
            Manage your personal information and instructor credentials.
        </p>
    </div>

    <div class="card p-4 mb-4">

        <h3 class="mb-4">Personal Information</h3>

        <form>

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Enter your full name"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    placeholder="Enter your email"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Enter your phone number"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Write a short bio"
                ></textarea>
            </div>

            <button type="button" class="btn btn-primary">
                Save Changes
            </button>

        </form>

    </div>


    <div class="card p-4">

        <h3 class="mb-4">Instructor Credentials</h3>

        <div class="mb-3">
            <label class="form-label">Qualification</label>
            <input
                type="text"
                class="form-control"
                placeholder="Example: Bachelor's Degree"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Specialization</label>
            <input
                type="text"
                class="form-control"
                placeholder="Example: Computer Science"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Years of Experience</label>
            <input
                type="number"
                class="form-control"
                placeholder="Years"
            >
        </div>

        <button type="button" class="btn btn-primary">
            Add Credential
        </button>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript -->
<script src="{{ asset('js/profile.js') }}"></script>

</body>
</html>
