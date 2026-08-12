document.addEventListener("DOMContentLoaded", function () {

    const saveButtons = document.querySelectorAll(".btn-primary");

    saveButtons.forEach(function (button) {

        button.addEventListener("click", function () {

            const card = button.closest(".card");

            if (!card) return;

            const inputs = card.querySelectorAll(
                "input, textarea, select"
            );

            let valid = true;

            inputs.forEach(function (input) {

                if (
                    input.hasAttribute("required") &&
                    input.value.trim() === ""
                ) {
                    valid = false;
                }

            });

            if (!valid) {
                alert("Please complete all required fields.");
                return;
            }

            alert("Changes saved successfully.");

        });

    });

});
