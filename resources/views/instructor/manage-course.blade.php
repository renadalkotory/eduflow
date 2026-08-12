<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Course - EduFlow</title>

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
        href="{{ asset('css/manage.css') }}"
    >
</head>

<body>


<nav class="navbar navbar-expand-lg bg-white border-bottom">

    <div class="container">

        <a class="navbar-brand fw-bold text-primary" href="#">
            <i class="bi bi-mortarboard-fill"></i>
            EduFlow
        </a>

        <div class="d-flex align-items-center gap-4">

            <a href="#" class="nav-link active">
                Browse Courses
            </a>

            <a href="#" class="nav-link">
                Categories
            </a>

            <a href="#" class="nav-link">
                Pricing
            </a>

            <a href="#" class="nav-link text-primary">
                Login
            </a>

            <button class="btn btn-primary px-4">
                Sign Up
            </button>

        </div>

    </div>

</nav>



<main class="container py-5">

    <div class="breadcrumb-area mb-3">

        <span>Courses</span>

        <i class="bi bi-chevron-right"></i>

        <span>Advanced Machine Learning</span>

        <i class="bi bi-chevron-right"></i>

        <strong>Curriculum</strong>

    </div>


    <div class="d-flex justify-content-between align-items-start mb-5">

        <div>

            <h1 class="page-title">
                Curriculum Builder
            </h1>

            <p class="page-description">
                Organize your course into manageable sections and lessons.
                Use the drag handles to reorder content.
            </p>

        </div>


        <div class="d-flex gap-3">

            <button
                type="button"
                class="btn preview-btn"
            >
                <i class="bi bi-eye"></i>

                Preview Course
            </button>


            <button
                type="button"
                class="btn btn-primary new-section-btn"
                id="newSectionBtn"
            >
                <i class="bi bi-plus-lg"></i>

                New Section
            </button>

        </div>

    </div>


    <div class="row g-4 mb-5">

        <div class="col-md-3">

            <div class="stat-card">

                <span>
                    TOTAL SECTIONS
                </span>

                <strong id="totalSections">
                    2
                </strong>

            </div>

        </div>


        <div class="col-md-3">

            <div class="stat-card">

                <span>
                    TOTAL LESSONS
                </span>

                <strong id="totalLessons">
                    3
                </strong>

            </div>

        </div>


        <div class="col-md-3">

            <div class="stat-card">

                <span>
                    TOTAL DURATION
                </span>

                <strong id="totalDuration">
                    45 mins
                </strong>

            </div>

        </div>


        <div class="col-md-3">

            <div class="stat-card">

                <span>
                    STATUS
                </span>

                <strong class="status-text">

                    <i class="bi bi-circle-fill"></i>

                    Draft

                </strong>

            </div>

        </div>

    </div>


    <div id="sectionsContainer">



        <div
            class="section-card mb-4"
            data-section
        >

            <div class="section-header">

                <div class="d-flex align-items-center gap-3">

                    <i class="bi bi-grip-vertical drag-handle"></i>

                    <div>

                        <div class="d-flex align-items-center gap-3">

                            <h3 class="section-title">
                                Section 1: Introduction to Neural Networks
                            </h3>

                            <span class="badge published-badge">
                                Published
                            </span>

                        </div>

                        <small class="section-meta">
                            <span class="lesson-count">
                                2 Lessons
                            </span>

                            • 45 mins
                        </small>

                    </div>

                </div>


                <div class="section-actions">

                    <button
                        type="button"
                        class="icon-btn edit-section"
                    >
                        <i class="bi bi-pencil"></i>
                    </button>


                    <button
                        type="button"
                        class="icon-btn toggle-section"
                    >
                        <i class="bi bi-chevron-up"></i>
                    </button>

                </div>

            </div>


            <div class="section-body">


                <!--leson -->

                <div class="lesson-row">

                    <i class="bi bi-grip-vertical drag-handle"></i>


                    <div class="lesson-icon video-icon">

                        <i class="bi bi-play-fill"></i>

                    </div>


                    <div class="lesson-info">

                        <strong>
                            1.1 What is a Neural Network?
                        </strong>

                        <small>
                            Video • 15:00
                        </small>

                    </div>


                    <button
                        type="button"
                        class="delete-lesson"
                    >
                        <i class="bi bi-trash"></i>
                    </button>

                </div>



                <div class="lesson-row">

                    <i class="bi bi-grip-vertical drag-handle"></i>


                    <div class="lesson-icon pdf-icon">

                        <i class="bi bi-file-earmark-pdf-fill"></i>

                    </div>


                    <div class="lesson-info">

                        <strong>
                            1.2 Architecture Overview (Slides)
                        </strong>

                        <small>
                            PDF • 2.4 MB
                        </small>

                    </div>


                    <button
                        type="button"
                        class="delete-lesson"
                    >
                        <i class="bi bi-trash"></i>
                    </button>

                </div>


                <button
                    type="button"
                    class="add-lesson-btn"
                >

                    <i class="bi bi-plus-lg"></i>

                    Add Lesson

                </button>

            </div>

        </div>

        <div
            class="section-card mb-4"
            data-section
        >

            <div class="section-header">

                <div class="d-flex align-items-center gap-3">

                    <i class="bi bi-grip-vertical drag-handle"></i>

                    <div>

                        <div class="d-flex align-items-center gap-3">

                            <h3 class="section-title">
                                Section 2: Activation Functions
                            </h3>

                            <span class="badge draft-badge">
                                Draft
                            </span>

                        </div>

                        <small class="section-meta">
                            <span class="lesson-count">
                                1 Lesson
                            </span>

                            • 20 mins
                        </small>

                    </div>

                </div>


                <div class="section-actions">

                    <button
                        type="button"
                        class="icon-btn edit-section"
                    >
                        <i class="bi bi-pencil"></i>
                    </button>


                    <button
                        type="button"
                        class="icon-btn toggle-section"
                    >
                        <i class="bi bi-chevron-down"></i>
                    </button>

                </div>

            </div>


            <div class="section-body collapsed">

                <button
                    type="button"
                    class="add-lesson-btn"
                >

                    <i class="bi bi-plus-lg"></i>

                    Add Lesson

                </button>

            </div>

        </div>


    </div>



    <button
        type="button"
        class="add-section-area"
        id="addSectionBtn"
    >

        <div class="add-section-circle">

            <i class="bi bi-plus-lg"></i>

        </div>

        <strong>
            Add New Section
        </strong>

    </button>


</main>


<div
    class="modal fade"
    id="sectionModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add New Section
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <label class="form-label">
                    Section Title
                </label>

                <input
                    type="text"
                    id="sectionTitle"
                    class="form-control"
                    placeholder="Example: Introduction to AI"
                >

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="saveSectionBtn"
                >
                    Add Section
                </button>

            </div>

        </div>

    </div>

</div>



<div
    class="modal fade"
    id="lessonModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add Lesson
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label">
                        Lesson Title
                    </label>

                    <input
                        type="text"
                        id="lessonTitle"
                        class="form-control"
                        placeholder="Example: Introduction to Machine Learning"
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Lesson Type
                    </label>

                    <select
                        id="lessonType"
                        class="form-select"
                    >

                        <option value="Video">
                            Video
                        </option>

                        <option value="PDF">
                            PDF
                        </option>

                        <option value="Quiz">
                            Quiz
                        </option>

                    </select>

                </div>


                <div>

                    <label class="form-label">
                        Duration
                    </label>

                    <input
                        type="text"
                        id="lessonDuration"
                        class="form-control"
                        placeholder="Example: 15:00"
                    >

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="saveLessonBtn"
                >
                    Add Lesson
                </button>

            </div>

        </div>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>
<script
    src="{{ asset('js/manage.js') }}">
</script>

</body>

</html>
