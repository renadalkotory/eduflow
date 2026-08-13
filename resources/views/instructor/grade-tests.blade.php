<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Grade Tests</title>

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
        href="{{ asset('css/grade-tests.css') }}"
    >

</head>


<body>

<nav class="navbar">
    <div class="logo">
        EduFlow
    </div>
    <div class="nav-links">
        <a href="{{ route('instructor.dashboard') }}">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>

        <a class="{{ request()->routeIs('instructor.createCourse') ? 'active' : '' }}"
        href="{{ route('instructor.createCourse') }}">
            Create Course
        </a>

        <a class="{{ request()->routeIs('instructor.manageCourse') ? 'active' : '' }}"
        href="{{ route('instructor.manageCourse') }}">
            Manage Course
        </a>

        <a class="{{ request()->routeIs('instructor.createQuiz') ? 'active' : '' }}"
        href="{{ route('instructor.createQuiz') }}">
            Create Quiz
        </a>

        <a class="{{ request()->routeIs('instructor.gradeTests') ? 'active' : '' }}"
        href="{{ route('instructor.gradeTests') }}">
            Grade Tests
        </a>

        <a class="{{ request()->routeIs('instructor.profile') ? 'active' : '' }}"
        href="{{ route('instructor.profile') }}">
            Profile
        </a>

    </div>

</nav>

<div class="container py-5">

    <div class="mb-4">

        <h1>Grade Tests</h1>

        <p class="text-muted">
            Review student submissions and update their grades.
        </p>

    </div>


    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="mb-1">
                    Student Submissions
                </h3>

                <small class="text-muted">
                    Review and grade submitted tests.
                </small>

            </div>


            <select class="form-select" style="width: 200px;">

                <option>
                    All Courses
                </option>

                <option>
                    Web Development
                </option>

                <option>
                    UI/UX Design
                </option>

            </select>

        </div>


        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>
                            Student
                        </th>

                        <th>
                            Course
                        </th>

                        <th>
                            Quiz
                        </th>

                        <th>
                            Submitted
                        </th>

                        <th>
                            Score
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>
                        eman
                        </td>

                        <td>
                            Web Development
                        </td>

                        <td>
                            HTML Basics
                        </td>

                        <td>
                            Today
                        </td>

                        <td>
                            85%
                        </td>

                        <td>

                            <span class="badge bg-success">
                                Passed
                            </span>

                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                            >
                                Review
                            </button>

                        </td>

                    </tr>


                    <tr>

                        <td>
                            Sara Mohamed
                        </td>

                        <td>
                            UI/UX Design
                        </td>

                        <td>
                            UX Basics
                        </td>

                        <td>
                            Yesterday
                        </td>

                        <td>
                            72%
                        </td>

                        <td>

                            <span class="badge bg-success">
                                Passed
                            </span>

                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                            >
                                Review
                            </button>

                        </td>

                    </tr>


                    <tr>

                        <td>
                            basmala
                        </td>

                        <td>
                            Web Development
                        </td>

                        <td>
                            CSS Basics
                        </td>

                        <td>
                            2 Days Ago
                        </td>

                        <td>
                            48%
                        </td>

                        <td>

                            <span class="badge bg-danger">
                                Failed
                            </span>

                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                            >
                                Review
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div><script
    src="{{ asset('js/grade-tests.js') }}">
</script>


</body>
</html>