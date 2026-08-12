
document.addEventListener("DOMContentLoaded", function () {
    const title =
        document.getElementById("courseTitle");

    const category =
        document.getElementById("courseCategory");

    const level =
        document.getElementById("courseLevel");

    const price =
        document.getElementById("coursePrice");

    const duration =
        document.getElementById("courseDuration");


    const summaryTitle =
        document.getElementById("summaryTitle");

    const summaryCategory =
        document.getElementById("summaryCategory");

    const summaryLevel =
        document.getElementById("summaryLevel");

    const summaryPrice =
        document.getElementById("summaryPrice");

    const summaryDuration =
        document.getElementById("summaryDuration");

    function updateSummary() {

        summaryTitle.textContent =
            title.value.trim() || "—";

        summaryCategory.textContent =
            category.value || "—";

        summaryLevel.textContent =
            level.value || "—";

        summaryPrice.textContent =
            price.value
                ? "$" + price.value
                : "$0";

        summaryDuration.textContent =
            duration.value.trim() || "—";

    }

    title.addEventListener(
        "input",
        updateSummary
    );

    category.addEventListener(
        "change",
        updateSummary
    );

    level.addEventListener(
        "change",
        updateSummary
    );

    price.addEventListener(
        "input",
        updateSummary
    );

    duration.addEventListener(
        "input",
        updateSummary
    );




    const imageInput =
        document.getElementById("courseImage");

    const previewImage =
        document.getElementById("previewImage");


    imageInput.addEventListener(
        "change",
        function () {

            const file =
                imageInput.files[0];

            if (!file) {
                return;
            }

            const reader =
                new FileReader();


            reader.onload =
                function (event) {

                    previewImage.src =
                        event.target.result;

                    previewImage.style.display =
                        "block";

                };


            reader.readAsDataURL(file);

        }
    );



    const addObjectiveBtn =
        document.getElementById(
            "addObjectiveBtn"
        );


    const objectivesContainer =
        document.getElementById(
            "objectivesContainer"
        );


    addObjectiveBtn.addEventListener(
        "click",
        function () {

            const row =
                document.createElement("div");


            row.className =
                "form-group objective-row";


            row.innerHTML = `

                <input
                    type="text"
                    class="form-control objective-input"
                    placeholder="Enter another learning objective">

            `;


            objectivesContainer.appendChild(row);

        }
    );



    document
        .querySelectorAll(".category-option")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    document
                        .querySelectorAll(
                            ".category-option"
                        )
                        .forEach(function (item) {

                            item.classList.remove(
                                "selected"
                            );

                        });


                    button.classList.add(
                        "selected"
                    );


                    category.value =
                        button.textContent.trim();

                    updateSummary();

                }
            );

        });



    function saveCourse(message) {

        const courseTitle =
            title.value.trim();


        if (courseTitle === "") {

            alert(
                "Please enter a course title."
            );

            title.focus();

            return;

        }


        const successMessage =
            document.getElementById(
                "successMessage"
            );


        successMessage.textContent =
            message;


        successMessage.classList.add(
            "show"
        );


        setTimeout(function () {

            successMessage.classList.remove(
                "show"
            );

        }, 3000);

    }


    document
        .getElementById("saveDraftBtn")
        .addEventListener(
            "click",
            function () {

                saveCourse(
                    "Course saved as draft successfully!"
                );

            }
        );


    document
        .getElementById("publishCourseBtn")
        .addEventListener(
            "click",
            function () {

                saveCourse(
                    "Course created successfully!"
                );

            }
        );




    document
        .getElementById("cancelCourseBtn")
        .addEventListener(
            "click",
            function () {

                const confirmed =
                    confirm(
                        "Are you sure you want to cancel?"
                    );


                if (confirmed) {

                    window.location.reload();

                }

            }
        );

});
