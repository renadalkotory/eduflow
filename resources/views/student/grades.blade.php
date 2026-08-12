<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Grades | EduFlow</title>

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
            max-width: 1100px;
            margin: 40px auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .page-header {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #6b7280;
        }

        .grade-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 18px;
        }

        .course-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .quiz-title {
            color: #4b5563;
            margin-bottom: 20px;
        }

        .grade-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding-top: 18px;
            border-top: 1px solid #e5e7eb;
        }

        .score {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
        }

        .score-label {
            color: #6b7280;
            font-size: 14px;
        }

        .attempt-date {
            color: #6b7280;
            font-size: 14px;
            text-align: right;
        }

        .empty {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            color: #6b7280;
        }

        @media (max-width: 700px) {
            .container {
                width: 92%;
            }

            .page-header h1 {
                font-size: 26px;
            }

            .grade-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .attempt-date {
                text-align: left;
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

        <section class="page-header">
            <h1>My Grades</h1>
            <p>
                View your quiz results and scores.
            </p>
        </section>

        @forelse($attempts as $attempt)

            <section class="grade-card">

                <div class="course-title">
                    {{ $attempt->quiz->section->course->title ?? 'Course' }}
                </div>

                <div class="quiz-title">
                    {{ $attempt->quiz->title ?? 'Quiz' }}
                </div>

                <div class="grade-row">

                    <div>
                        <div class="score">
                            {{ $attempt->score }}
                            /
                            {{ $attempt->quiz->total_marks ?? 0 }}
                        </div>

                        <div class="score-label">
                            Quiz Score
                        </div>
                    </div>

                    <div class="attempt-date">
                        Attempted on<br>

                        {{ $attempt->attempt_date
                            ? $attempt->attempt_date->format('M d, Y - h:i A')
                            : 'N/A'
                        }}
                    </div>

                </div>

            </section>

        @empty

            <div class="empty">
                You have no quiz grades yet.
            </div>

        @endforelse

    </main>

</body>
</html>