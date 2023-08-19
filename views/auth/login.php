<h1 class="page-name">Login</h1>
<p class="page-description"> Start Session</p>
<?php include_once __DIR__."/../templates/alerts.php"; ?>
<form class="form" method="POST" action="/">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="email" name="email">
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="password" name="password">
    </div>
    <input class="button" type="submit" value="Start Session">
</form>
<div class="actions">
    <a href="/create-account">Create Account</a>
    <a href="/forgot">Forgot Password</a>
</div>
