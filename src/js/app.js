let step = 1;
document.addEventListener('DOMContentLoaded', function () {
    startApp();
})

function startApp() {
    tabs(); //change sections whenever click on a tab
}

function displaySection() {
    //console.log('Displaying section');
}

function tabs() {
    const buttons = document.querySelectorAll('.tabs button');
    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            //console.log(e.target.dataset.step)

            step = parseInt(e.target.dataset.step);
            displaySection();

        })
    })
}