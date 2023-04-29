// Wait for the window to finish loading before executing the script
window.onload = function () {
    // Select the necessary HTML elements and assign them to variables
    const container = document.querySelector(".bo-container");
    const leftSection = document.querySelector(".bo-left-section");
    const divider = document.querySelector(".divider");
    const rightSection = document.querySelector(".bo-right-section");

    // Initialize variables to keep track of the resize state
    let isResizing = false;
    let prevX = 0;

    // Define a function to resize the left section based on mouse movement
    function resizeElement(e) {
        // If resizing is not in progress, exit the function
        if (!isResizing) return;
        // Calculate the amount the mouse has moved horizontally
        const newX = e.clientX;
        const diffX = newX - prevX;
        // Calculate the width of the container and the new width of the left section
        const containerWidth = container.offsetWidth;
        const newWidth = ((leftSection.offsetWidth + diffX) / containerWidth) * 100;
        // Check if the new width is within the allowed range, and if so, set the new width and update the previous x position
        if (newWidth > 10 && newWidth < 50) {
            leftSection.style.flexBasis = `${newWidth}%`;
            prevX = newX;
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
