    const inProgressBtn =
        document.getElementById('inProgressBtn');

    const completedBtn =
        document.getElementById('completedBtn');

    const inProgressCourses =
        document.getElementById('inProgressCourses');

    const completedCourses =
        document.getElementById('completedCourses');


    // In Progress
    inProgressBtn.addEventListener('click', function () {

        inProgressCourses.style.display = 'block';

        completedCourses.style.display = 'none';

        inProgressBtn.classList.remove('btn-secondary');
        inProgressBtn.classList.add('btn-primary');

        completedBtn.classList.remove('btn-primary');
        completedBtn.classList.add('btn-secondary');

    });


    // Completed
    completedBtn.addEventListener('click', function () {

        completedCourses.style.display = 'block';

        inProgressCourses.style.display = 'none';

        completedBtn.classList.remove('btn-secondary');
        completedBtn.classList.add('btn-primary');

        inProgressBtn.classList.remove('btn-primary');
        inProgressBtn.classList.add('btn-secondary');

    });