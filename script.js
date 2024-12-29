let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

// Listen for scroll events
window.addEventListener('scroll', function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        // User is scrolling down, collapse the navbar
        if (!navbar.classList.contains('navbar-collapse-hide')) {
            navbar.classList.add('navbar-collapse-hide');
            navbar.classList.remove('show');
        }
    } else {
        // User is scrolling up, expand the navbar
        if (navbar.classList.contains('navbar-collapse-hide')) {
            navbar.classList.remove('navbar-collapse-hide');
            navbar.classList.add('show');
        }
    }

    // Update the last scroll position
    lastScrollTop = scrollTop;
});