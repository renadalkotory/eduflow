@extends('layouts.student')

@section('title', $course->title)


@section('content')

<div class="container-fluid">

    <!-- Back -->
    <div class="mb-4">
        <a href="{{ route('student.dashboard') }}"
           class="text-decoration-none">
            ← Back to Dashboard
        </a>
    </div>

    <div class="row g-4">

        
        <div class="col-lg-8">

            <!-- Course Title -->
            <div class="mb-3">

                <small class="text-uppercase text-muted">
                    Course
                </small>

                <h1 class="fw-bold">
                    {{ $course->title }}
                </h1>

                <p class="text-muted">
                    {{ $course->description }}
                </p>

            </div>


            <!-- VIDEO -->
            <div class="video-container">

                <iframe
                    id="courseVideo"
                    width="100%"
                    height="500"
                    src=""
                    title="Course Video"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>

            </div>


            <!-- Current Lesson -->
            <div class="mt-4">

                <h3 id="lessonTitle">
                    Select a lesson
                </h3>

                <p id="lessonDuration"
                   class="text-muted">
                </p>

            </div>

        </div>


        <!-- RIGHT: Lessons -->
        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0">
                        Course Content
                    </h5>

                </div>


                <div class="card-body p-0">

                    @foreach($sections as $section)

                        <div class="section">

                            <!-- Section Title -->
                            <div class="p-3 bg-light fw-bold">

                                {{ $section->title ?? 'Section ' . $section->section_id }}

                            </div>


                            <!-- Lessons -->
                            <div>

                                @foreach($section->lessons as $lesson)

                                    <button
                                        type="button"
                                        class="lesson-item"
                                        onclick="playLesson(
                                            '{{ $lesson->video_url }}',
                                            '{{ addslashes($lesson->title) }}',
                                            '{{ $lesson->duration }}'
                                        )">

                                        <div>

                                            <strong>
                                                {{ $lesson->lesson_order }}.
                                                {{ $lesson->title }}
                                            </strong>

                                            <small class="d-block text-muted">
                                                {{ $lesson->duration }}
                                            </small>

                                        </div>

                                        <i class="bi bi-play-circle"></i>

                                    </button>

                                @endforeach

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/courseplayer.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('js/courseplayer.js') }}"></script>
@endsection    