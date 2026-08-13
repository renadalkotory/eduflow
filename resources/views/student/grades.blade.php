@extends('layouts.student')

@section('title', 'Grades')

@section('content')

<div class="container">

    <h2 class="mb-4">My Grades</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($grades->isEmpty())

        <div class="alert alert-info">
            You haven't completed any quizzes yet.
        </div>

    @else

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Quiz</th>
                        <th>Score</th>
                        <th>Total Questions</th>
                        <th>Percentage</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{ $grade->title }}</td>
                            <td>{{ $grade->score }}</td>
                            <td>{{ $grade->total_questions }}</td>
                            <td>
                                <span class="badge {{ $grade->percentage >= 60 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $grade->percentage }}%
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($grade->attempt_date)->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    @endif

</div>

@endsection