<h1 class="page-name">Forgot Password</h1>
<p class="page-description"> Forgot Password</p>
<?php include_once __DIR__."/../templates/alerts.php"; ?>
<form class="form" method="POST" action="/forgot">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="email" name="email">
    </div>
    <input class="button" type="submit" value="Send"/>
</form>
<div class="actions">
    <a href="/">Start Session</a>
    <a href="/create-account">Create Account</a>
</div>