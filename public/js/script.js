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

    // Dark mode toggle
    const toggleBtn = document.getElementById('themeToggleBtn');
    const icon = document.getElementById('themeIcon');
    const body = document.body;

    const syncIcon = () => {
      if (icon) icon.className = body.classList.contains('dark-mode') ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
    };
    syncIcon();

    if (toggleBtn) {
      toggleBtn.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
        syncIcon();
      });
    }
});

// Apply saved theme immediately (before DOMContentLoaded) to avoid a light-mode flash
(function () {
  const savedTheme = localStorage.getItem('theme') || 'light';
  if (savedTheme === 'dark') document.body.classList.add('dark-mode');
})();