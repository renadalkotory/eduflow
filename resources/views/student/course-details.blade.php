<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $course->title }} | EduFlow</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 7%;
        }

        .navbar a {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
            font-size: 20px;
        }

        .container {
            width: 86%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .course-header {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid #e5e7eb;
        }

        .course-header h1 {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .course-description {
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .course-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .info-item {
            background: #f8fafc;
            padding: 12px 18px;
            border-radius: 8px;
        }

        .info-item span {
            font-weight: bold;
        }

        .section {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .section-header {
            background: #f8fafc;
            padding: 20px 25px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-header h2 {
            font-size: 20px;
        }

        .content {
            padding: 20px 25px;
        }

        .content-title {
            font-size: 15px;
            font-weight: bold;
            color: #6b7280;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .lesson,
        .file,
        .quiz {
            padding: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #ffffff;
        }

        .lesson:last-child,
        .file:last-child,
        .quiz:last-child {
            margin-bottom: 0;
        }

        .lesson-title,
        .file-title,
        .quiz-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .details {
            color: #6b7280;
            font-size: 14px;
        }

        .empty {
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 700px) {
            .container {
                width: 92%;
            }

            .course-header h1 {
                font-size: 26px;
            }

            .course-info {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="{{ route('home') }}">EduFlow</a>
    </nav>

    <main class="container">

        <a href="{{ route('home') }}" class="back">
            ← Back
        </a>

        {{-- Course Information --}}
        <section class="course-header">

            <h1>{{ $course->title }}</h1>

            <p class="course-description">
                {{ $course->description }}
            </p>

            <div class="course-info">

                <div class="info-item">
                    <span>Instructor:</span>
                    {{ $course->instructor->full_name ?? 'N/A' }}
                </div>

                <div class="info-item">
                    <span>Category:</span>
                    {{ $course->category->category_name ?? 'N/A' }}
                </div>

                <div class="info-item">
                    <span>Price:</span>
                    ${{ number_format((float) $course->price, 2) }}
                </div>

                <div class="info-item">
                    <span>Views:</span>
                    {{ $course->views }}
                </div>

            </div>

        </section>


        {{-- Course Sections --}}
        @forelse($course->sections as $section)

            <section class="section">

                <div class="section-header">
                    <h2>
                        {{ $section->section_order }}.
                        {{ $section->title }}
                    </h2>
                </div>

                <div class="content">

                    {{-- Lessons --}}
                    <div class="content-title">
                        Lessons
                    </div>

                    @forelse($section->lessons as $lesson)

                        <div class="lesson">

                            <div class="lesson-title">
                                {{ $lesson->lesson_order }}.
                                {{ $lesson->title }}
                            </div>

                            <div class="details">
                                Duration: {{ $lesson->duration ?? 'N/A' }}
                            </div>

                        </div>

                    @empty

                        <p class="empty">
                            No lessons available in this section.
                        </p>

                    @endforelse


                    {{-- Files --}}
                    <div class="content-title">
                        Course Files
                    </div>

                    @forelse($section->files as $file)

                        <div class="file">

                            <div class="file-title">
                                {{ $file->title }}
                            </div>

                            <div class="details">
                                {{ $file->file_path }}
                            </div>

                        </div>

                    @empty

                        <p class="empty">
                            No files available in this section.
                        </p>

                    @endforelse


                    {{-- Quizzes --}}
                    <div class="content-title">
                        Quizzes
                    </div>

                    @forelse($section->quizzes as $quiz)

                        <div class="quiz">

                            <div class="quiz-title">
                                {{ $quiz->title }}
                            </div>

                            <div class="details">
                                Total Marks: {{ $quiz->total_marks }}
                            </div>

                        </div>

                    @empty

                        <p class="empty">
                            No quizzes available in this section.
                        </p>

                    @endforelse

                </div>

            </section>

        @empty

            <section class="section">
                <div class="content">
                    <p class="empty">
                        No sections are available for this course yet.
                    </p>
                </div>
            </section>

        @endforelse

    </main>

</body>
</html>