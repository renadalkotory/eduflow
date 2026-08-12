document.addEventListener("DOMContentLoaded", function () {

    const addButton = document.querySelector(
        ".btn-primary"
    );

    const saveButton = document.querySelector(
        ".btn-success"
    );

    let questionNumber = 1;


    if (addButton) {

        addButton.addEventListener("click", function () {

            questionNumber++;

            const questionsContainer =
                document.querySelector(".card:last-child");

            if (!questionsContainer) return;

            const question = document.createElement("div");

            question.className =
                "border rounded p-3 mb-3 question-item";

            question.innerHTML = `

                <h5>
                    Question ${questionNumber}
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

                    <option>Option A</option>
                    <option>Option B</option>
                    <option>Option C</option>
                    <option>Option D</option>

                </select>

                <button
                    type="button"
                    class="btn btn-sm btn-danger mt-3 delete-question">
                    Delete Question
                </button>

            `;

            questionsContainer.appendChild(question);

        });

    }


    document.addEventListener(
        "click",
        function (event) {

            if (
                event.target.classList.contains(
                    "delete-question"
                )
            ) {

                const question =
                    event.target.closest(
                        ".question-item"
                    );

                question?.remove();

            }

        }
    );


    if (saveButton) {

        saveButton.addEventListener("click", function () {

            const title = document.querySelector(
                'input[placeholder="Enter quiz title"]'
            );

            if (!title || title.value.trim() === "") {

                alert("Please enter a quiz title.");

                title?.focus();

                return;
            }

            alert("Quiz saved successfully!");

        });

    }

});
