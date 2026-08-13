<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Quiz</title>

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
        href="{{ asset('css/create-quiz.css') }}"
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

        <h1>Create Quiz</h1>

        <p class="text-muted">
            Create a quiz and add questions for your students.
        </p>

    </div>


    <div class="card p-4 mb-4">

        <h3 class="mb-4">
            Quiz Information
        </h3>


        <div class="mb-3">

            <label class="form-label">
                Quiz Title
            </label>

            <input
                type="text"
                class="form-control"
                placeholder="Enter quiz title"
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Description
            </label>

            <textarea
                class="form-control"
                rows="3"
                placeholder="Enter quiz description"
            ></textarea>

        </div>


        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Course
                </label>

                <select class="form-select">

                    <option selected>
                        Select Course
                    </option>

                    <option>
                        Web Development
                    </option>

                    <option>
                        UI/UX Design
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Passing Score
                </label>

                <input
                    type="number"
                    class="form-control"
                    placeholder="Example: 60"
                >

            </div>

        </div>

    </div>


    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="mb-0">
                Questions
            </h3>

            <button
                type="button"
                class="btn btn-primary"
            >
                + Add Question
            </button>

        </div>


        <div class="border rounded p-3 mb-3">

            <h5>
                Question 1
            </h5>

            <input
                type="text"
                class="form-control mb-3"
                placeholder="Enter question"
            >


            <label class="form-label">
                Answer Options
            </label>

            <input
                type="text"
                class="form-control mb-2"
                placeholder="Option A"
            >

            <input
                type="text"
                class="form-control mb-2"
                placeholder="Option B"
            >

            <input
                type="text"
                class="form-control mb-2"
                placeholder="Option C"
            >

            <input
                type="text"
                class="form-control mb-3"
                placeholder="Option D"
            >


            <label class="form-label">
                Correct Answer
            </label>

            <select class="form-select">

                <option>
                    Option A
                </option>

                <option>
                    Option B
                </option>

                <option>
                    Option C
                </option>

                <option>
                    Option D
                </option>

            </select>

        </div>


        <button
            type="button"
            class="btn btn-success"
        >
            Save Quiz
        </button>

    </div>

</div>
<script
    src="{{ asset('js/create-quize.js') }}">
</script>
</body>
</html>