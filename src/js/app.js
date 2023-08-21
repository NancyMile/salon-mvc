let step = 1;
let initialStep = 1;
let lastStep = 3;

const appointment = {
    name: '',
    date: '',
    time: '',
    services: []
}

document.addEventListener('DOMContentLoaded', function () {
    startApp();
})

function startApp() {
    displaySection();
    tabs(); //change sections whenever click on a tab
    paginationButtons(); //adds or removes pagination buttons
    previousPage();
    nextPage();
    queryingAPI();
    clientName();
    selectDate(); //adds date to the appointment object
    seletTime(); // adds time on appoiment object
    displayResume();
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
        displayResume();
    }
    else {
        prevPage.classList.remove('hide');
        nextPage.classList.remove('hide');
    }
}

function previousPage() {
    const prevPage = document.querySelector('#previous');
    prevPage.addEventListener('click', function () {
        if (step <= initialStep) return
            step--;
        paginationButtons();
        displaySection();
    })
}

function nextPage() {
    const nextPage = document.querySelector('#next');
    nextPage.addEventListener('click', function () {
        if (step >= lastStep) return
            step++;
        paginationButtons();
        displaySection();
    })
}

async function queryingAPI() {

    try {
        const url = 'http://localhost:8080/services';
        const result = await fetch(url);
        const services = await result.json();
        //console.log(services);
        displayServices(services);
    } catch (error) {
        console.log(error);
    }
}

function displayServices(services) {
    services.forEach(service => {
        const { id, name, price } = service;
        //console.log(name);

        const serviceName = document.createElement('P');
        serviceName.classList.add('service-name');
        serviceName.textContent = name;

        const servicePrice = document.createElement('P');
        servicePrice.classList.add('service-price');
        servicePrice.textContent = `$ ${price}`;

        const serviceDiv = document.createElement('DIV');
        serviceDiv.classList.add('service');
        serviceDiv.dataset.idService = id  //data-id-service = id ej 1 ...
        serviceDiv.onclick = function () {
            selectService(service)
        };

        //console.log(serviceDiv);

        serviceDiv.appendChild(serviceName);
        serviceDiv.appendChild(servicePrice);

        //add this div to appointmens
        document.querySelector('#services').appendChild(serviceDiv);

    });
}

function selectService(service) {
    //console.log('from select service');
    //console.log(service)

    const { id } = service;

    const { services } = appointment;

    const divService = document.querySelector(`[data-id-service="${id}"]`);

    // checks if a service has been added
    if (services.some(alreadyAdded => alreadyAdded.id === id)) {
        //remmove service
        appointment.services = services.filter(alreadyAdded => alreadyAdded.id !== id);
        //console.log(appointment);
        divService.classList.remove('selected');

    } else {
        //add new service
        //takes a copy of services and adds the new service
        appointment.services = [...services, service];
        //console.log(appointment);
        divService.classList.add('selected');
    }
}

function clientName() {
    appointment.name = document.querySelector('#name').value;
};

function selectDate() {
    const inputDate = document.querySelector('#date');
    inputDate.addEventListener('input', function (e) {
        //console.log("date selected");
        //console.log(e.target.value);
        const day = new Date(e.target.value).getUTCDay(); //days 0 t0 6 Sunday is 0
        if ([0, 6].includes(day)) {
            //no working on weekends
            e.target.value = ''
            displayAlert('Close on weekends','error','.form');
        } else {
            appointment.date = e.target.value;
        }
    });
}

function seletTime() {
    const inputTime = document.querySelector('#time');
    inputTime.addEventListener('input', function (e) {
        //console.log(e.target.value)
        const time = e.target.value;
        const hour = time.split(':')[0];
        if (hour > 10 && hour < 18) {
            //valid hours
            appointment.time = e.target.value;
        } else {
            //closed
            e.target.value = '';
            displayAlert('Open from 10am to 6pm','error','.form');
        }
    });
}

function displayAlert(message, type, element,removeAlert = true) {
    //prevent duplicate alert
    const prevAlert = document.querySelector('.alert');
    if (prevAlert) {
        prevAlert.remove();
    };

    //create alerts
    const alert = document.createElement('DIV');
    alert.textContent = message;
    alert.classList.add('alert');
    alert.classList.add(type);

    const form = document.querySelector(element);
    form.appendChild(alert);

    //remove message after 3 sec
    if(removeAlert) {
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
}

function displayResume() {
    const resume = document.querySelector('.content-resume');

    // clean resume
    while (resume.firstChild) {
        resume.removeChild(resume.firstChild);
    }

    if (Object.values(appointment).includes('') || appointment.services.length === 0)  {
        //console.log('Datos missing');
        displayAlert('Services,date or time missing.','error','.content-resume',false);

        return;
    }

    //all good, now format div resume
    const { name, date, time, services } = appointment;

    const clientName = document.createElement('P');
    clientName.innerHTML = `<span>Name:</span>${name}`;

    const appointmentDate = document.createElement('P');
    appointmentDate.innerHTML = `<span>Date:</span>${date}`;

    const appointmentTime = document.createElement('P');
    appointmentTime.innerHTML = `<span>Time:</span>${time}`;


    services.forEach(service => {
        const { id, name, price } = service;
        const containerService = document.createElement('DIV');
        containerService.classList.add('container-service')

        const textService = document.createElement('P');
        textService.textContent = name;

        const priceService = document.createElement('P');
        priceService.innerHTML = `<span>Price:</span>$${price}`;

        containerService.appendChild(textService);
        containerService.appendChild(priceService);

        //add on resume
        resume.appendChild(containerService);
    })

    resume.appendChild(clientName);
    resume.appendChild(appointmentDate);
    resume.appendChild(appointmentTime);

    //console.log(appointment);
}