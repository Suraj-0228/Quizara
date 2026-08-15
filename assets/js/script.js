// Mock Bootstrap JavaScript interactive components using Tailwind CSS classes
window.bootstrap = {
    Modal: function (element) {
        this.element = element;
        this.show = function () {
            if (!this.element) return;
            this.element.classList.remove('hidden');
            this.element.classList.add('flex');
        };
        this.hide = function () {
            if (!this.element) return;
            this.element.classList.add('hidden');
            this.element.classList.remove('flex');
        };
    },
    Alert: function (element) {
        this.element = element;
        this.close = function () {
            if (this.element) this.element.remove();
        };
    },
    Tooltip: function (element) {
        this.element = element;
    }
};

// Global Helper Functions for Mobile Navigation
window.quizaraToggleNavbar = function (e) {
    if (e && e.stopPropagation) e.stopPropagation();
    var nav = document.getElementById('navbarNav');
    if (!nav) return;
    var isHidden = nav.classList.contains('hidden') || nav.style.display === 'none' || getComputedStyle(nav).display === 'none';
    if (isHidden) {
        nav.classList.remove('hidden');
        nav.style.display = 'block';
        nav.style.visibility = 'visible';
    } else {
        nav.classList.add('hidden');
        nav.style.display = 'none';
    }
};

window.quizaraToggleSidebar = function (e) {
    if (e) {
        if (typeof e.stopPropagation === 'function') e.stopPropagation();
    }
    var sidebar = document.querySelector('.admin-sidebar, .student-sidebar');
    var backdrop = document.querySelector('.sidebar-backdrop');
    if (!sidebar) return;

    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.className = 'sidebar-backdrop fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 hidden transition-opacity';
        document.body.appendChild(backdrop);
        backdrop.addEventListener('click', function () {
            sidebar.classList.remove('active-sidebar');
            backdrop.classList.add('hidden');
        });
    }

    var isActive = sidebar.classList.toggle('active-sidebar');
    if (isActive) {
        backdrop.classList.remove('hidden');
    } else {
        backdrop.classList.add('hidden');
    }
};

document.addEventListener('DOMContentLoaded', function () {
    // Auto-hide all alert messages system-wide after 2 seconds (2000ms)
    function autoDismissAlerts() {
        const alerts = document.querySelectorAll('.alert-dismissible, .flash-alert-msg, [role="alert"]');
        alerts.forEach(alert => {
            if (alert.dataset.autodismissed) return;
            alert.dataset.autodismissed = "true";

            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out, margin 0.5s ease-out';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    if (alert && alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            }, 2000);
        });
    }

    autoDismissAlerts();

});

// Global click delegation for custom Tailwind dropdowns, collapse menus, and modals
document.addEventListener('click', function (e) {
    // 1. Modal Dismiss Button (data-bs-dismiss="modal")
    const dismissBtn = e.target.closest('[data-bs-dismiss="modal"]');
    if (dismissBtn) {
        const modal = dismissBtn.closest('.modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // 2. Dropdown Menu Toggle (data-bs-toggle="dropdown")
    const dropdownToggle = e.target.closest('[data-bs-toggle="dropdown"]');
    if (dropdownToggle) {
        e.preventDefault();
        const dropdownMenu = dropdownToggle.nextElementSibling || dropdownToggle.parentElement.querySelector('.dropdown-menu');
        if (dropdownMenu) {
            dropdownMenu.classList.toggle('hidden');
        }
    } else {
        // Clicked outside dropdown: close all open dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (!menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    }

    // 3. Navbar Collapse Toggle (data-bs-toggle="collapse")
    const collapseToggle = e.target.closest('[data-bs-toggle="collapse"]');
    if (collapseToggle) {
        window.quizaraToggleNavbar(e);
    } else {
        // Clicked outside collapse: auto-close open mobile navbar
        const nav = document.getElementById('navbarNav');
        if (nav && !nav.contains(e.target) && !nav.classList.contains('hidden')) {
            nav.classList.add('hidden');
            nav.style.display = 'none';
        }
    }
});
