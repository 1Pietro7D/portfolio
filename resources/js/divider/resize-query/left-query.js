export function leftWindowResize() {
    const leftSection = document.querySelector(".bo-left-section");

    if (window.innerWidth < 768) {
        leftSection.classList.add('d-none');
    }
    else if (window.innerWidth >= 768) {
        leftSection.classList.remove('d-none');
        leftSection.style.flexBasis = "190px";
    }
}
