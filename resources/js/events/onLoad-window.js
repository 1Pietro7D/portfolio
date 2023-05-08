import * as bo_resizer from '../divider/bo-resizer';
// Wait for the window to finish loading before executing the script
window.onload = function () {
    //function load
    bo_resizer.resizer();
    showForm();
}

function showForm() {
    if (document.querySelectorAll(".expand-form")) {
        const buttons = document.querySelectorAll(".expand-form")
        buttons.forEach((btn, i) => {
            console.log(i);
            btn.addEventListener("click", function () {
                const dataId = btn.dataset.data_item;
                console.log(dataId);
                console.log(i);
                const item_edit = document.getElementById(dataId);
                item_edit.classList.toggle('d-none');
                if (i > 0) { // 0 is Create btn
                    const icon = btn.querySelector('i');
                    console.log(icon);
                    icon.classList.toggle('fa-pen');
                    icon.classList.toggle('fa-square-minus');
                    btn.classList.toggle('btn-primary');
                    btn.classList.toggle('btn-warning');
                }
            });
        })
        const btn_create = document.getElementById('create-btn');
        if (btn_create) {
            btn_create.addEventListener("click", function () {
                const icon = document.getElementById('create-icon');
                icon.classList.toggle('fa-square-plus');
                icon.classList.toggle('fa-square-minus');
                btn_create.classList.toggle('btn-primary');
                btn_create.classList.toggle('btn-warning');
            });
        }

    }
}

