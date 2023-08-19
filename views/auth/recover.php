<h1 class="page-name">Reset Password</h1>
<p class="page-description"> Reset Password</p>
<?php include_once __DIR__."/../templates/alerts.php"; 
    if($error) return
?>
<form class="form" method="POST">
    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="password" name="password">
    </div>
    <input class="button" type="submit" value="Send"/>
</form>
<div class="actions">
    <a href="/">Start Session</a>
    <a href="/create-account">Create Account</a>
</div>