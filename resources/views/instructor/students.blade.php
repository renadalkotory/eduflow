<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Students</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/students.css') }}"
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

        <a class="{{ request()->routeIs('instructor.students') ? 'active' : '' }}"
        href="{{ route('instructor.students') }}">
            Students
        </a>

        <a class="{{ request()->routeIs('instructor.profile') ? 'active' : '' }}"
        href="{{ route('instructor.profile') }}">
            Profile
        </a>

    </div>

</nav>

<div class="container py-5">

    <div class="mb-4">
        <h1>My Students</h1>
        <p class="text-muted">
            Everyone currently enrolled in your courses.
        </p>
    </div>

    @if($students->isEmpty())

        <div class="alert alert-info">
            No students enrolled in your courses yet.
        </div>

    @else

        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Enrolled On</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->course_title }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->enrolled_at)->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    @endif

</div>

</body>
</html>