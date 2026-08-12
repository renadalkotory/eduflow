@extends('layouts.student')

@section('title', $quiz->title)

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>{{ $quiz->title }}</h2>
            <p class="text-muted">
                Answer all questions
            </p>
        </div>

        <a href="{{ route('student.quizzes') }}"
           class="btn btn-outline-secondary">
            ← Back to Quizzes
        </a>

    </div>


    <form action="{{ route('student.quiz.submit', ['quiz_id' => $quiz->quiz_id]) }}"
          method="POST">

        @csrf

        @foreach($questions as $index => $question)

            <div class="card mb-4 shadow-sm">

                <div class="card-body">

                    <h5 class="mb-3">
                        {{ $index + 1 }}.
                        {{ $question->question }}
                    </h5>


                    @foreach($question->options as $option)

                        <div class="form-check mb-2">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="answers[{{ $question->question_id }}]"
                                value="{{ $option->option_id }}"
                                id="option{{ $option->option_id }}"
                                required
                            >

                            <label
                                class="form-check-label"
                                for="option{{ $option->option_id }}"
                            >
                                {{ $option->option_text }}
                            </label>

                        </div>

                    @endforeach

                </div>

            </div>

        @endforeach


        <div class="text-center mb-5">

            <button type="submit"
                    class="btn btn-success btn-lg">
                Submit Quiz
            </button>

        </div>

    </form>

</div>

@endsection