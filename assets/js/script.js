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

document.addEventListener('DOMContentLoaded', function () {
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Sidebar Toggle (Admin & Student)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.admin-sidebar, .student-sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            sidebar.classList.toggle('active-sidebar');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function (e) {
            if (sidebar.classList.contains('active-sidebar') &&
                !sidebar.contains(e.target) &&
                e.target !== sidebarToggle &&
                !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('active-sidebar');
            }
        });
    }
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
        e.preventDefault();
        const targetId = collapseToggle.getAttribute('data-bs-target');
        if (targetId) {
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                targetEl.classList.toggle('hidden');
            }
        }
    }
});
