document.addEventListener("DOMContentLoaded", function () {

    const courseFilter = document.querySelector(
        ".form-select"
    );

    const reviewButtons = document.querySelectorAll(
        ".btn-primary"
    );


    if (courseFilter) {

        courseFilter.addEventListener("change", function () {

            const selectedCourse =
                this.value.toLowerCase();

            const rows = document.querySelectorAll(
                "tbody tr"
            );

            rows.forEach(function (row) {

                const courseCell =
                    row.children[1];

                if (!courseCell) return;

                const course =
                    courseCell.textContent
                        .trim()
                        .toLowerCase();

                if (
                    selectedCourse === "all courses" ||
                    course === selectedCourse
                ) {

                    row.style.display = "";

                } else {

                    row.style.display = "none";

                }

            });

        });

    }


    reviewButtons.forEach(function (button) {

        button.addEventListener("click", function () {

            const row =
                button.closest("tr");

            if (!row) return;

            const student =
                row.children[0]?.textContent.trim();

            const quiz =
                row.children[2]?.textContent.trim();

            alert(
                "Reviewing " +
                quiz +
                " submitted by " +
                student
            );

        });

    });

});
