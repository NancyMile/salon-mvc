document.addEventListener('DOMContentLoaded', function () {
    startApp();
});

function startApp() {
    searchByDate();
}

function searchByDate() {
    //console.log('searching by date');
    const inpurtDate = document.querySelector('#date');
    inpurtDate.addEventListener('input', function (e) {
        const selectedDate = e.target.value;
        window.location = `?date=${selectedDate}`;
    });
 }