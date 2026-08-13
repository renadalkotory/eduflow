@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
<!-- Dashboard Header -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <small class="text-uppercase text-muted">
            Student Dashboard
        </small>

        <h1 class="dashboard-title">
            Welcome back, {{ $student->full_name }}
        </h1>

    </div>

    <div class="d-flex align-items-center gap-3">

        <div class="date-badge">

            <i class="bi bi-calendar3"></i>

            {{ \Carbon\Carbon::now()->format('M d, Y') }}

        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="btn btn-danger">

                <i class="bi bi-box-arrow-right"></i>
                Logout

            </button>

        </form>

    </div>

</div>

<!-- Statistics -->
<div class="row g-3 mb-5">

    <!-- Courses in Progress -->
    <div class="col-md-4">

        <div class="dashboard-card">

            <div>

                <p class="card-label">
                    Courses in Progress
                </p>

                <h3 class="card-number">
                    {{ $coursesInProgress }}
                </h3>

            </div>

            <div class="dashboard-icon blue-icon">

                <i class="bi bi-book"></i>

            </div>

        </div>

    </div>


    <!-- Completed Courses -->
    <div class="col-md-4">

        <div class="dashboard-card">

            <div>

                <p class="card-label">
                    Completed Courses
                </p>

                <h3 class="card-number">
                    {{ $completedCourses }}
                </h3>

            </div>

            <div class="dashboard-icon green-icon">

                <i class="bi bi-award"></i>

            </div>

        </div>

    </div>


    <!-- Average Grade -->
    <div class="col-md-4">

        <div class="dashboard-card">

            <div>

                <p class="card-label">
                    Overall Average Grade
                </p>

                <h3 class="card-number">
                    {{ $averageGrade }}%
                </h3>

            </div>

            <div class="dashboard-icon purple-icon">

                <i class="bi bi-graph-up"></i>

            </div>

        </div>

    </div>

</div>



<!-- Dashboard Main Section -->

<div class="row g-5">


    <!-- Continue Learning -->

    <div class="col-lg-8">

        <div class="section-header">

            <h4>
                Continue Learning
            </h4>

            <a href="{{ route('student.courses') }}">
                View All →
            </a>

        </div>


        <div class="row g-3">

            @forelse($courses as $course)

                <div class="col-md-6">

                    <a
                        href="{{ route('student.courseplayer', $course->course_id) }}"
                        class="text-decoration-none"
                    >

                        <div class="course-card">


                            <!-- Course Image -->

                            @if($course->thumbnail)

                                <img
                                    src="{{ asset('images/courses/' . $course->thumbnail) }}"
                                    alt="{{ $course->title }}"
                                    class="course-image"
                                >

                            @else

                                <div
                                    class="course-image d-flex align-items-center justify-content-center bg-light"
                                >

                                    <i class="bi bi-book fs-1 text-muted"></i>

                                </div>

                            @endif


                            <!-- Course Body -->

                            <div class="course-body">

                                <small class="course-category">
                                    COURSE
                                </small>


                                <h5>
                                    {{ $course->title }}
                                </h5>


                                <p>
                                    {{ $course->description }}
                                </p>


                                <div class="course-info">

                                    <span>

                                        {{ $course->progress }}% Complete

                                    </span>


                                    <span>

                                        {{ $course->completedLessons }}
                                        /
                                        {{ $course->totalLessons }}
                                        lessons

                                    </span>

                                </div>


                                <!-- Progress -->

                                <div class="progress course-progress">

                                    <div
                                        class="progress-bar"
                                        style="width: {{ $course->progress }}%;"
                                    >
                                    </div>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-info">

                        You are not enrolled in any courses yet.

                    </div>

                </div>

            @endforelse


            <!-- Explore Courses -->

            <div class="col-md-6">

                <a
                    href="{{ route('browse.courses') }}"
                    class="explore-card"
                >

                    <div class="search-circle">

                        <i class="bi bi-search"></i>

                    </div>

                    <span>
                        Explore more courses
                    </span>

                </a>

            </div>

        </div>

    </div>



    <!-- ========================= -->
    <!-- Recent Activity -->
    <!-- ========================= -->

    <div class="col-lg-4">

        <h4 class="section-title">
            Recent Activity
        </h4>


        <!-- Activity 1 -->

        <div class="activity-card">

            <div class="activity-icon blue-activity">

                <i class="bi bi-play"></i>

            </div>


            <div>

                <small>
                    Today
                </small>

                <p>
                    Continue learning your courses.
                </p>

                <a
                    href="{{ route('student.courses') }}"
                    class="resume-button"
                >
                    Resume Learning →
                </a>

            </div>

        </div>



        <!-- Activity 2 -->

        <div class="activity-card">

            <div class="activity-icon purple-activity">

                <i class="bi bi-journal-check"></i>

            </div>


            <div>

              @if($recentQuiz)

    <small>
        {{ \Carbon\Carbon::parse($recentQuiz->attempt_date)->format('M d, Y') }}
    </small>


                    <p>

                        Quiz completed:

                        <strong>
                            {{ $recentQuiz->title }}
                        </strong>

                    </p>


                    <a
                        href="{{ route('student.grades') }}"
                        class="prepare-button"
                    >
                        View Grade
                    </a>

                @else

                    <small>
                        No quiz completed yet
                    </small>

                    <p>
                        Take your first quiz.
                    </p>

                    <a
                        href="{{ route('student.quizzes') }}"
                        class="prepare-button"
                    >
                        Prepare for Quiz
                    </a>

                @endif

            </div>

        </div>



        <!-- Activity 3 -->

        <div class="activity-card">

            <div class="activity-icon green-activity">

                <i class="bi bi-check"></i>

            </div>


            <div>

                <small>
                    Your Grades
                </small>

                <p>
                    Check your quiz results.
                </p>

                <a
                    href="{{ route('student.grades') }}"
                    class="prepare-button"
                >
                    Go to Grades
                </a>

            </div>

        </div>

    </div>

</div>

@endsection


@section('css')

<link
    rel="stylesheet"
    href="{{ asset('css/dashboard.css') }}"
>

@endsection