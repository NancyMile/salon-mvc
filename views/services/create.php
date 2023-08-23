<h1 class="page-name">Create Service</h1>
<p class="page-description">Create Service</p>
<?php include_once __DIR__.'/../templates/bar.php' ?>
<?php include_once __DIR__.'/../templates/alerts.php' ?>
<form action="/services/create" method="POST" class="form">
    <?php include_once __DIR__.'/form.php' ?>
    <input type="submit" value="Save Service" class="button">
</form>