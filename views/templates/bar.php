<div class="bar">
    <p> Welcome <?php echo $name ?? '' ?></p>
    <a class="button" href="/logout">Logout</a>
</div>
<?php if(isset($_SESSION['admin'])): ?>
    <div class="bar-services">
        <a class="button" href="/admin">Appointment</a>
        <a class="button" href="/services">Services</a>
        <a class="button" href="/services/create">New Service</a>
    </div>
<?php endif; ?>