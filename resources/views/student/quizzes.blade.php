@extends('layouts.student')

@section('title', 'Quizzes')

@section('content')

<div class="container">

    <h2 class="mb-4">Available Quizzes</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        @foreach($quizzes as $quiz)

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h4>{{ $quiz->title }}</h4>

                        <p class="text-muted">
                            Test your knowledge
                        </p>

                        <a href="{{ route('student.quiz', ['quiz_id' => $quiz->quiz_id]) }}"
                           class="btn btn-primary">
                            Start Quiz
                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection