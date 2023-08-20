<h1 class="page-name">Appointments</h1>
<p class="page-description"> Appointments</p>
<?php include_once __DIR__."/../templates/alerts.php"; ?>
<div id="app">
    <nav class="tabs">
        <button type="button" data-step="1" class="active">Services</button>
        <button type="button" data-step="2">Appointment Info</button>
        <button type="button" data-step="3">Resumen</button>

    </nav>
    <div class="section" id="step-1">
        <h1>Select Services</h1>
        <div class="services-list" id="services"></div>
    </div>
    <div class="section" id="step-2">
        <h1>Details and appoinment</h1>
        <p class="text-center">Your Details and appontment date.</p>
        <form class="form">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" placeholder="name" id="name" value="<?php echo $name ?>" disabled>
            </div>
            <div class="field">
                <label for="date">Date</label>
                <input type="date" id="date">
            </div>
            <div class="field">
                <label for="time">time</label>
                <input type="time" id="time">
            </div>
            <input type="submit" value="Book" class="button">
        </form>
    </div>
    <div class="section" id="step-3">
        <h1>Resumen</h1>
        <p class="text-center">Please Check the details are correct.</p>
        <div class="services-list" id="services"></div>
    </div>
</div>
