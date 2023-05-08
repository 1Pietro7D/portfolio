// Bootstrap navbar collapse
export function collapseNavbar() {
    // query in container for bootstrap navbar
    const nav_header = document.querySelector("#nav-header");
    const rightSection = document.querySelector(".bo-right-section");
    const nav_hidden = document.querySelector(".nav-hidden");
    // Check if the right section is less than 768px
    if (rightSection.offsetWidth < 766) {
        nav_header.classList.add('navbar-expand-xxl');
        nav_header.classList.add('flex-xxl-nowrap');
        nav_header.classList.remove('navbar-expand-md');
        nav_header.classList.remove('flex-md-nowrap');
        nav_hidden.classList.remove('d-md-none')
    }
    else {
        nav_header.classList.remove('navbar-expand-xxl');
        nav_header.classList.remove('flex-xxl-nowrap');
        nav_header.classList.add('navbar-expand-md');
        nav_header.classList.add('flex-md-nowrap')
        nav_hidden.classList.add('d-md-none')
    }
}

