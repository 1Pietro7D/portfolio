import * as Right from './resize-query/right-query.js';
import * as Left from './resize-query/left-query.js';
import * as BsResize from './resize-query/bootstrap-query.js';

export function resizer() {
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
    // load size onload
    handleWindowResize()

    // Define a function to resize the left section based on mouse movement
    function resizeElement(e) {

        // If resizing is not in progress, exit the function
        if (!isResizing) return;

        // Calculate the amount the mouse has moved horizontally
        const newX = e.clientX;
        const diffX = newX - prevX;

        // Find the width of the container of my app (100vw)
        const containerWidth = container.offsetWidth;
        // Calculate the new width of the left section
        let newWidth = ((leftSection.offsetWidth + diffX) / containerWidth) * 100;
        // resize leftSection
        leftSection.style.flexBasis = `${newWidth}%`;
        prevX = newX;
        // resize other elements
        BsResize.collapseNavbar();
        Right.rightWindowResize();
        // naturaly dont resize leftWindowResize

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
    BsResize.collapseNavbar();
    Left.leftWindowResize();
    Right.rightWindowResize();
}

// resize if resize windows viewport
window.addEventListener('resize', handleWindowResize);


