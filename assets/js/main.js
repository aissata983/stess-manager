document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';

    sidebarLinks.forEach((link) => {
        const href = link.getAttribute('href');
        if (!href) return;

        const linkPath = new URL(href, window.location.origin).pathname.replace(/\/+$/, '') || '/';

        if (linkPath === currentPath) {
            link.style.background = 'rgba(255, 255, 255, 0.14)';
            link.style.fontWeight = '700';
        }
    });
});
