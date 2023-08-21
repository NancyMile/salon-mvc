let step = 1;
document.addEventListener('DOMContentLoaded', function () {
    startApp();
})

function startApp() {
    displaySection();
    tabs(); //change sections whenever click on a tab
    paginationButtons(); //adds or removes pagination buttons
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
            paginationButtons();
        })
    })
}

function paginationButtons() {
    const prevPage = document.querySelector('#previous');
    const nextPage = document.querySelector('#next');

    if (step === 1) {
        prevPage.classList.add('hide');
        nextPage.classList.remove('hide');
    }
    else if (step === 3) {
        prevPage.classList.remove('hide');
        nextPage.classList.add('hide');
    }
    else {
        prevPage.classList.remove('hide');
        nextPage.classList.remove('hide');
    }

}