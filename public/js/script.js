document.addEventListener('DOMContentLoaded', function () {
    // Courses carousel (landing page)
    const prevBtn = document.getElementById('prevCourse');
    const nextBtn = document.getElementById('nextCourse');
    const courseRow = document.querySelector('#courses .row');

    if (prevBtn && nextBtn && courseRow) {
        const scrollAmount = 300;
        prevBtn.addEventListener('click', () => courseRow.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
        nextBtn.addEventListener('click', () => courseRow.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
    }

    // Password show/hide (login + signup pages)
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (togglePassword && passwordInput && toggleIcon) {
        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    }

    // Role tabs (login page)
    const roleTabs = document.querySelectorAll('.role-tab');
    const roleInput = document.getElementById('roleInput');

    if (roleTabs.length && roleInput) {
        roleTabs.forEach(tab => {
            tab.addEventListener('click', function () {
                roleTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                roleInput.value = tab.getAttribute('data-role');
            });
        });
    }

    // Role cards (signup page)
    const roleCards = document.querySelectorAll('.role-card');

    if (roleCards.length && roleInput) {
        roleCards.forEach(card => {
            card.addEventListener('click', function () {
                roleCards.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                roleInput.value = this.dataset.role;
            });
        });
    }
});
// document.addEventListener('DOMContentLoaded', function () {
//     const prevBtn = document.getElementById('prevCourse');
//     const nextBtn = document.getElementById('nextCourse');
//     const courseRow = document.querySelector('#courses .row');

//     if (!prevBtn || !nextBtn || !courseRow) return;

//     const scrollAmount = 300;

//     prevBtn.addEventListener('click', function () {
//         courseRow.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
//     });

//     nextBtn.addEventListener('click', function () {
//         courseRow.scrollBy({ left: scrollAmount, behavior: 'smooth' });
//     });
// });


// // home page
// document.addEventListener('DOMContentLoaded', function () {
//     const prevBtn = document.getElementById('prevCourse');
//     const nextBtn = document.getElementById('nextCourse');
//     const courseRow = document.querySelector('#courses .row');

//     if (!prevBtn || !nextBtn || !courseRow) return;

//     const scrollAmount = 300;

//     prevBtn.addEventListener('click', function () {
//         courseRow.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
//     });

//     nextBtn.addEventListener('click', function () {
//         courseRow.scrollBy({ left: scrollAmount, behavior: 'smooth' });
//     });
// });



// // login 

// document.addEventListener('DOMContentLoaded', function () {

//     const togglePassword = document.getElementById('togglePassword');
//     const passwordInput = document.getElementById('password');
//     const toggleIcon = document.getElementById('toggleIcon');

//     togglePassword.addEventListener('click', function () {
//         const isPassword = passwordInput.getAttribute('type') === 'password';
//         passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
//         toggleIcon.classList.toggle('bi-eye');
//         toggleIcon.classList.toggle('bi-eye-slash');
//     });

    
//     const roleTabs = document.querySelectorAll('.role-tab');
//     const roleInput = document.getElementById('roleInput');

//     roleTabs.forEach(function (tab) {
//         tab.addEventListener('click', function () {
//             roleTabs.forEach(function (t) { t.classList.remove('active'); });
//             tab.classList.add('active');
//             roleInput.value = tab.getAttribute('data-role');
//         });
//     });

// });

// document.addEventListener('DOMContentLoaded', function () {
//     const roleCards = document.querySelectorAll('.role-card');
//     const roleInput = document.getElementById('roleInput');

//     roleCards.forEach(card => {
//         card.addEventListener('click', function () {
//             roleCards.forEach(c => c.classList.remove('active'));
//             this.classList.add('active');
//             roleInput.value = this.dataset.role;
//         });
//     });

//     const togglePassword = document.getElementById('togglePassword');
//     const password = document.getElementById('password');
//     const toggleIcon = document.getElementById('toggleIcon');

//     togglePassword.addEventListener('click', function () {
//         const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
//         password.setAttribute('type', type);
//         toggleIcon.classList.toggle('bi-eye');
//         toggleIcon.classList.toggle('bi-eye-slash');
//     });
// });