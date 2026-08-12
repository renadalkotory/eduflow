@extends('layouts.student')

@section('title', 'My Courses')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold">My Courses</h2>

        <p class="text-muted">
            Continue learning and track your progress.
        </p>
    </div>


    <!-- Filter Buttons -->
    <div class="mb-4">

        <button
            type="button"
            id="inProgressBtn"
            class="btn btn-primary me-2"
        >
            In Progress
        </button>

        <button
            type="button"
            id="completedBtn"
            class="btn btn-secondary"
        >
            Completed
        </button>

    </div>


    <!-- ================================= -->
    <!-- IN PROGRESS COURSES -->
    <!-- ================================= -->

    <div id="inProgressCourses">

        <div class="row">

            @php
                $hasInProgress = false;
            @endphp


            @foreach($courses as $course)

                @if($course->status == 'in_progress')

                    @php
                        $hasInProgress = true;
                    @endphp


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="card h-100 shadow-sm">


                            <!-- Course Image -->
                            @if($course->thumbnail)

                                <img
                                    src="{{ asset('images/courses/' . $course->thumbnail) }}"
                                    class="card-img-top"
                                    style="height: 200px; object-fit: cover;"
                                    alt="{{ $course->title }}"
                                >

                            @else

                                <div
                                    class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 200px;"
                                >
                                    <i class="bi bi-book fs-1 text-muted"></i>
                                </div>

                            @endif


                            <!-- Card Body -->
                            <div class="card-body">

                                <small class="text-uppercase text-muted">
                                    Course
                                </small>

                                <h5 class="card-title fw-bold mt-1">
                                    {{ $course->title }}
                                </h5>


                                <p class="text-muted">
                                    {{ $course->description }}
                                </p>


                                <!-- Progress -->
                                <div class="d-flex justify-content-between mb-2">

                                    <span>
                                        Progress
                                    </span>

                                    <span class="fw-bold">
                                        {{ $course->progress }}%
                                    </span>

                                </div>


                                <div
                                    class="progress mb-3"
                                    style="height: 8px;"
                                >

                                    <div
                                        class="progress-bar"
                                        style="width: {{ $course->progress }}%;"
                                    ></div>

                                </div>


                                <small class="text-muted">

                                    {{ $course->completedLessons }}
                                    /
                                    {{ $course->totalLessons }}

                                    lessons completed

                                </small>

                            </div>


                            <!-- Card Footer -->
                            <div class="card-footer bg-white border-0">

                                <a
                                    href="{{ route('student.courseplayer', $course->course_id) }}"
                                    class="btn btn-primary w-100"
                                >
                                    Continue Learning
                                </a>

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach


            <!-- No Courses -->
            @if(!$hasInProgress)

                <div class="col-12">

                    <div class="alert alert-info">
                        You don't have any courses in progress.
                    </div>

                </div>

            @endif

        </div>

    </div>


    <!-- ================================= -->
    <!-- COMPLETED COURSES -->
    <!-- ================================= -->

    <div
        id="completedCourses"
        style="display: none;"
    >

        <div class="row">

            @php
                $hasCompleted = false;
            @endphp


            @foreach($courses as $course)

                @if($course->status == 'completed')

                    @php
                        $hasCompleted = true;
                    @endphp


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="card h-100 shadow-sm">


                            <!-- Course Image -->
                            @if($course->thumbnail)

                                <img
                                    src="{{ asset('images/courses/' . $course->thumbnail) }}"
                                    class="card-img-top"
                                    style="height: 200px; object-fit: cover;"
                                    alt="{{ $course->title }}"
                                >

                            @else

                                <div
                                    class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 200px;"
                                >
                                    <i class="bi bi-book fs-1 text-muted"></i>
                                </div>

                            @endif


                            <!-- Card Body -->
                            <div class="card-body">

                                <small class="text-uppercase text-muted">
                                    Course
                                </small>

                                <h5 class="card-title fw-bold mt-1">
                                    {{ $course->title }}
                                </h5>


                                <p class="text-muted">
                                    {{ $course->description }}
                                </p>


                                <!-- Completed -->
                                <div class="text-success mb-3">

                                    <i class="bi bi-check-circle-fill"></i>

                                    Course Completed

                                </div>


                                <!-- Progress -->
                                <div
                                    class="progress mb-2"
                                    style="height: 8px;"
                                >

                                    <div
                                        class="progress-bar bg-success"
                                        style="width: 100%;"
                                    ></div>

                                </div>


                                <small class="text-muted">

                                    {{ $course->completedLessons }}
                                    /
                                    {{ $course->totalLessons }}

                                    lessons completed

                                </small>

                            </div>


                            <!-- Card Footer -->
                            <div class="card-footer bg-white border-0">

                                <a
                                    href="{{ route('student.courseplayer', $course->course_id) }}"
                                    class="btn btn-success w-100"
                                >
                                    Review Course
                                </a>

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach


            <!-- No Completed Courses -->
            @if(!$hasCompleted)

                <div class="col-12">

                    <div class="alert alert-info">
                        You have not completed any courses yet.
                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection


<!-- ================================= -->
<!-- JAVASCRIPT -->
<!-- ================================= -->

@section('scripts')

<script src="{{ asset('js/courses.js') }}"></script>

@endsection