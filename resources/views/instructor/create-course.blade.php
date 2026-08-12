<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Course</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Our CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/create-course.css') }}"
    >

</head>

<body>


<!--navbar-->

<nav class="navbar">
    <div class="logo">
        EduFlow
    </div>
    <div class="nav-links">
        <a class="active"
        href="{{ route('instructor.createCourse') }}">
            Create Course
        </a>

        <a href="{{ route('instructor.manageCourse') }}">
            Manage Course
        </a>

        <a href="{{ route('instructor.createQuiz') }}">
            Create Quiz
        </a>

        <a href="{{ route('instructor.gradeTests') }}">
            Grade Tests
        </a>

    </div>

</nav>


<!--main -->

<main class="page">
    <div class="course-header">
        <div>
            <h1>
                Create Course
            </h1>
            <p>
                Create and organize your new course.
            </p>
        </div>
    </div>

    <div id="successMessage"
        class="success-message">
        Course saved successfully!
    </div>
    <div class="course-layout">


        <!--left side-->

        <div>
            <div class="course-card">
                <h2>
                    Course Information
                </h2>
                <div class="form-group">
                    <label>
                        Course Title
                    </label>
                    <input
                        type="text"
                        id="courseTitle"
                        class="form-control"
                        placeholder="Enter course title">
                </div>
                <div class="form-group">
                    <label>
                        Short Description
                    </label>
                    <textarea
                        id="courseDescription"
                        placeholder="Write a short description about your course"></textarea>
                </div>
                <div class="form-group">
                    <label>
                        Course Description
                    </label>
                    <textarea
                        id="courseLongDescription"
                        rows="7"
                        placeholder="Describe what students will learn in this course"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Category
                        </label>
                        <select
                            id="courseCategory"
                            class="form-select">
                            <option value="">
                                Select Category
                            </option>
                            <option value="programming">
                                Programming
                            </option>
                            <option value="web">
                                Web Development
                            </option>
                            <option value="design">
                                UI/UX Design
                            </option>
                            <option value="data">
                                Data Science
                            </option>
                            <option value="business">
                                Business
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            Level
                        </label>
                        <select
                            id="courseLevel"
                            class="form-select">
                            <option value="">
                                Select Level
                            </option>
                            <option>
                                Beginner
                            </option>
                            <option>
                                Intermediate
                            </option>
                            <option>
                                Advanced
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Course Price
                        </label>
                        <input
                            type="number"
                            id="coursePrice"
                            class="form-control"
                            placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label>
                            Estimated Duration
                        </label>
                        <input
                            type="text"
                            id="courseDuration"
                            class="form-control"
                            placeholder="Example: 12 hours">

                    </div>

                </div>

            </div>




            <div class="course-card">

                <h2>
                    Course Thumbnail
                </h2>

                <label
                    for="courseImage"
                    class="upload-box">

                    <i class="bi bi-cloud-arrow-up"></i>

                    <strong>
                        Upload Course Image
                    </strong>

                    <p>
                        PNG, JPG or JPEG
                    </p>

                    <p>
                        Recommended: 1280 * 720
                    </p>

                </label>

                <input
                    type="file"
                    id="courseImage"
                    accept="image/png,image/jpeg"
                    hidden>
                <img
                    id="previewImage"
                    class="preview-image"
                    alt="Course preview">
            </div>
            <!-- LEARNING OBJECTIVES -->

            <div class="course-card">

                <h2>
                    What Students Will Learn
                </h2>


                <div id="objectivesContainer">

                    <div class="form-group objective-row">

                        <input
                            type="text"
                            class="form-control objective-input"
                            placeholder="Example: Build modern websites">

                    </div>

                </div>


                <button
                    type="button"
                    class="btn btn-light"
                    id="addObjectiveBtn">

                    Add Learning Objective

                </button>

            </div>

        </div>


        <!--rightside-->

        <div>
            <div class="side-card">

                <h3>
                    Course Summary
                </h3>
                <div class="summary-row">
                    <span>
                        Title
                    </span>
                    <strong id="summaryTitle">
                        —
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Category
                    </span>

                    <strong id="summaryCategory">
                        —
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Level
                    </span>

                    <strong id="summaryLevel">
                        —
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Price
                    </span>

                    <strong id="summaryPrice">
                        $0
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Duration
                    </span>

                    <strong id="summaryDuration">
                        —
                    </strong>

                </div>

            </div>


            <div class="side-card">

                <h3>
                    Course Status
                </h3>


                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select
                        id="courseStatus"
                        class="form-select">

                        <option value="draft">
                            Draft
                        </option>

                        <option value="published">
                            Published
                        </option>

                    </select>

                </div>


                <p style="color:#697386;font-size:13px;">
                    Save as draft if you want to continue
                    editing the course later.
                </p>

            </div>


            <div class="side-card">

                <h3>
                    Course Categories
                </h3>


                <div class="category-list">

                    <button
                        type="button"
                        class="category-option">

                        Programming

                    </button>

                    <button
                        type="button"
                        class="category-option">

                        Web Development

                    </button>

                    <button
                        type="button"
                        class="category-option">

                        UI/UX

                    </button>

                    <button
                        type="button"
                        class="category-option">

                        Data Science

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!--action-->

    <div class="course-actions">

        <button
            type="button"
            class="btn btn-light"
            id="cancelCourseBtn">

            Cancel

        </button>
        <button
            type="button"
            class="btn btn-primary"
            id="saveDraftBtn">
            Save Draft
        </button>
        <button
            type="button"
            class="btn btn-primary"
            id="publishCourseBtn">
            Create Course
        </button>
    </div>
</main>



<footer class="footer">

    <div class="logo">
        EduFlow
    </div>

    <p>
        Empowering lifelong learners through
        expert-led courses.
    </p>

</footer>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<script
    src="{{ asset('js/create-course.js') }}">
</script>


</body>
</html>
