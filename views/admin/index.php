<h1 class="page-name">Admin panel</h1>
<p class="page-description"> Admin Panel</p>
<?php include_once __DIR__."/../templates/bar.php"; ?>
<h2>Search Appointments</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
        </div>
    </form>
</div>
<div id="appointments-admin"></div>