let step = 1;
document.addEventListener('DOMContentLoaded', function () {
    startApp();
})

function startApp() {
    displaySection();
    tabs(); //change sections whenever click on a tab
}

function displaySection() {
    //console.log('Displaying section');

    //hide the secction that already hass the class visible
    const previousSection = document.querySelector('.visible');
    if (previousSection) {
        previousSection.classList.remove('visible');
    }

    //display the section with the selected step
    const section = document.querySelector(`#step-${step}`);
    section.classList.add('visible');

    //remove prev tab highlight
    const prevTab = document.querySelector('.active');
    if (prevTab) {
        prevTab.classList.remove('active')
    }
    //hightlight selected tab
    const tab = document.querySelector(`[data-step="${step}"]`);
    tab.classList.add('active');
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