
document.addEventListener("DOMContentLoaded", function () {
    const sectionsContainer =
        document.getElementById("sectionsContainer");

    const newSectionBtn =
        document.getElementById("newSectionBtn");

    const addSectionBtn =
        document.getElementById("addSectionBtn");

    const sectionModalElement =
        document.getElementById("sectionModal");

    const lessonModalElement =
        document.getElementById("lessonModal");

    const sectionTitle =
        document.getElementById("sectionTitle");

    const saveSectionBtn =
        document.getElementById("saveSectionBtn");

    const lessonTitle =
        document.getElementById("lessonTitle");

    const lessonType =
        document.getElementById("lessonType");

    const lessonDuration =
        document.getElementById("lessonDuration");

    const saveLessonBtn =
        document.getElementById("saveLessonBtn");

    let currentSection = null;


    const sectionModal =
        new bootstrap.Modal(sectionModalElement);

    const lessonModal =
        new bootstrap.Modal(lessonModalElement);


    function openSectionModal() {

        sectionTitle.value = "";

        sectionModal.show();

    }


    if (newSectionBtn) {

        newSectionBtn.addEventListener(
            "click",
            openSectionModal
        );

    }


    if (addSectionBtn) {

        addSectionBtn.addEventListener(
            "click",
            openSectionModal
        );

    }

    saveSectionBtn.addEventListener(
        "click",
        function () {

            const title =
                sectionTitle.value.trim();


            if (title === "") {

                alert(
                    "Please enter a section title."
                );

                return;

            }


            const section =
                document.createElement("div");


            section.className =
                "section-card mb-4";


            section.setAttribute(
                "data-section",
                ""
            );


            section.innerHTML = `

                <div class="section-header">

                    <div class="d-flex align-items-center gap-3">

                        <i class="bi bi-grip-vertical drag-handle"></i>

                        <div>

                            <div class="d-flex align-items-center gap-3">

                                <h3 class="section-title">
                                    Section ${getSectionNumber()}: ${escapeHtml(title)}
                                </h3>

                                <span class="badge draft-badge">
                                    Draft
                                </span>

                            </div>

                            <small class="section-meta">
                                <span class="lesson-count">
                                    0 Lessons
                                </span>

                                • 0 mins
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

                    <button
                        type="button"
                        class="add-lesson-btn"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Add Lesson

                    </button>

                </div>

            `;


            sectionsContainer.appendChild(section);


            sectionModal.hide();


            attachSectionEvents(section);


            updateStats();

        }
    );


    function attachSectionEvents(section) {

        const toggleBtn =
            section.querySelector(".toggle-section");


        const sectionBody =
            section.querySelector(".section-body");


        toggleBtn.addEventListener(
            "click",
            function () {

                sectionBody.classList.toggle(
                    "collapsed"
                );


                const icon =
                    toggleBtn.querySelector("i");


                if (
                    sectionBody.classList.contains(
                        "collapsed"
                    )
                ) {

                    icon.className =
                        "bi bi-chevron-down";

                } else {

                    icon.className =
                        "bi bi-chevron-up";

                }

            }
        );


        const deleteExistingLessonButtons =
            section.querySelectorAll(
                ".delete-lesson"
            );


        deleteExistingLessonButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        button
                            .closest(".lesson-row")
                            .remove();

                        updateLessonCount(
                            section
                        );

                        updateStats();

                    }
                );

            }
        );


        const addLessonBtn =
            section.querySelector(
                ".add-lesson-btn"
            );


        if (addLessonBtn) {

            addLessonBtn.addEventListener(
                "click",
                function () {

                    currentSection =
                        section;

                    lessonTitle.value = "";

                    lessonDuration.value = "";

                    lessonType.value = "Video";

                    lessonModal.show();

                }
            );

        }

    }



    document
        .querySelectorAll("[data-section]")
        .forEach(
            function (section) {

                attachSectionEvents(section);

            }
        );


    saveLessonBtn.addEventListener(
        "click",
        function () {

            if (!currentSection) {

                return;

            }


            const title =
                lessonTitle.value.trim();


            const type =
                lessonType.value;


            const duration =
                lessonDuration.value.trim();


            if (title === "") {

                alert(
                    "Please enter a lesson title."
                );

                return;

            }


            let icon =
                "bi-play-fill";


            let iconClass =
                "video-icon";


            if (type === "PDF") {

                icon =
                    "bi-file-earmark-pdf-fill";

                iconClass =
                    "pdf-icon";

            }


            if (type === "Quiz") {

                icon =
                    "bi-question-circle-fill";

                iconClass =
                    "video-icon";

            }


            const lesson =
                document.createElement("div");


            lesson.className =
                "lesson-row";


            lesson.innerHTML = `

                <i class="bi bi-grip-vertical drag-handle"></i>

                <div class="lesson-icon ${iconClass}">

                    <i class="bi ${icon}"></i>

                </div>

                <div class="lesson-info">

                    <strong>
                        ${escapeHtml(title)}
                    </strong>

                    <small>
                        ${type}

                        ${
                            duration
                                ? " • " + escapeHtml(duration)
                                : ""
                        }
                    </small>

                </div>

                <button
                    type="button"
                    class="delete-lesson"
                >

                    <i class="bi bi-trash"></i>

                </button>

            `;


            const addButton =
                currentSection.querySelector(
                    ".add-lesson-btn"
                );


            currentSection
                .querySelector(".section-body")
                .insertBefore(
                    lesson,
                    addButton
                );


            lesson
                .querySelector(".delete-lesson")
                .addEventListener(
                    "click",
                    function () {

                        lesson.remove();

                        updateLessonCount(
                            currentSection
                        );

                        updateStats();

                    }
                );


            updateLessonCount(
                currentSection
            );


            updateStats();


            lessonModal.hide();

        }
    );



    function updateLessonCount(section) {

        const lessons =
            section.querySelectorAll(
                ".lesson-row"
            );


        const counter =
            section.querySelector(
                ".lesson-count"
            );


        const count =
            lessons.length;


        counter.textContent =
            count === 1
                ? "1 Lesson"
                : count + " Lessons";

    }



    function updateStats() {

        const sections =
            document.querySelectorAll(
                "[data-section]"
            );


        const lessons =
            document.querySelectorAll(
                ".lesson-row"
            );


        document.getElementById(
            "totalSections"
        ).textContent =
            sections.length;


        document.getElementById(
            "totalLessons"
        ).textContent =
            lessons.length;

    }


    function getSectionNumber() {

        return document.querySelectorAll(
            "[data-section]"
        ).length + 1;

    }


    function escapeHtml(text) {

        const div =
            document.createElement("div");

        div.textContent = text;

        return div.innerHTML;

    }

});
