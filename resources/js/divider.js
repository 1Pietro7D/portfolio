// Wait for the window to finish loading before executing the script
window.onload = function () {
    // Select the necessary HTML elements and assign them to variables
    const container = document.querySelector(".bo-container");
    let leftSection = document.querySelector(".bo-left-section");
    const divider = document.querySelector(".divider");
    let rightSection = document.querySelector(".bo-right-section");
    //manegment limit exception
    //sm 576px
    //md 768px
    rightSection.style.minWidth = "574px";
    leftSection.style.minWidth = "190px";
    leftSection.style.maxWidth = "calc(100% - 576px)";
    // Initialize variables to keep track of the resize state
    let isResizing = false;
    let prevX = 0;

    handleWindowResize()
    // Define a function to resize the left section based on mouse movement
    function resizeElement(e) {
        // If resizing is not in progress, exit the function
        if (!isResizing) return;

        // Calculate the amount the mouse has moved horizontally
        const newX = e.clientX;
        const diffX = newX - prevX;

        // Calculate the width of the container and the new width of the left section
        const containerWidth = container.offsetWidth;

        let newWidth = ((leftSection.offsetWidth + diffX) / containerWidth) * 100;
        leftSection.style.flexBasis = `${newWidth}%`;
        prevX = newX;

        // query in container for bootstrap navbar
        let nav_header = document.querySelector("#nav-header");

        // Check if the right section is less than 768px
        if (rightSection.offsetWidth < 766) {
            nav_header.classList.add('navbar-expand-xxl');
            nav_header.classList.add('flex-xxl-nowrap');
            nav_header.classList.remove('navbar-expand-md');
            nav_header.classList.remove('flex-md-nowrap');

        } else {
            nav_header.classList.remove('navbar-expand-xxl');
            nav_header.classList.remove('flex-xxl-nowrap');
            nav_header.classList.add('navbar-expand-md');
            nav_header.classList.add('flex-md-nowrap');

        }


    }

    // Define a function to stop resizing
    function stopResize() {
        isResizing = false;
    }

    // Add an event listener to the divider to start resizing when the mouse is pressed down
    divider.addEventListener("mousedown", function (e) {
        // Prevent the default action of selecting text when dragging the divider
        e.preventDefault();

        // Set the resizing state to true and record the initial position of the mouse
        isResizing = true;
        prevX = e.clientX;

        // Add event listeners to the body to resize the element and stop resizing when the mouse is released
        document.body.addEventListener("mousemove", resizeElement);
        document.body.addEventListener("mouseup", stopResize);
    });
};

// my query js
function handleWindowResize() {
    let nav_header = document.querySelector("#nav-header");
    let leftSection = document.querySelector(".bo-left-section");
    let rightSection = document.querySelector(".bo-right-section");
    if (window.innerWidth < 768) {
        leftSection.classList.add('d-none');

        nav_header.classList.add('navbar-expand-md');
        nav_header.classList.add('flex-md-nowrap');
        rightSection.style.minWidth = "0px";
    } else if (window.innerWidth >= 768) {
        leftSection.classList.remove('d-none');
        nav_header.classList.remove('navbar-expand-md');
        nav_header.classList.remove('flex-md-nowrap');

        leftSection.style.flexBasis = "190px";
        rightSection.style.minWidth = "574pxpx";
    }
}

window.addEventListener('resize', handleWindowResize);

