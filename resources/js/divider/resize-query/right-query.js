export function rightWindowResize() {
    setHeightProjectCard();

    const rightSection = document.querySelector(".bo-right-section");
    if (window.innerWidth < 768) {
        rightSection.style.minWidth = "0px";
    } else if (window.innerWidth >= 768) {
        rightSection.style.minWidth = "574pxpx";
    }

}
// perfect project-card square
function setHeightProjectCard() {
    const container = document.querySelector(".container-body");
    // IF EXIST IN HTML
    if (document.querySelector(".proj-card")) {
        const cardProjects = document.querySelectorAll(".proj-card");
        cardProjects.forEach(card => {

            // set quantity card
            const quantity = setQuantityCardsQuery();
            if (quantity == 1.1) {
                card.style.margin = "auto";
            }
            else {
                card.style.margin = "";
            }

            card.style.width = container.offsetWidth / quantity + "px";
            card.style.height = container.offsetWidth / quantity + "px";

        });
    }
}

function setQuantityCardsQuery() {
    const sizePx = document.querySelector(".container-body").offsetWidth;
    let quantity = 1;

    if (sizePx < 578)
        quantity = 1.1 // with 1 will block
    if (sizePx >= 578)
        quantity = 2
    if (sizePx > 768)
        quantity = 3
    if (sizePx > 992)
        quantity = 3
    if (sizePx > 1200)
        quantity = 4

    return quantity
}
