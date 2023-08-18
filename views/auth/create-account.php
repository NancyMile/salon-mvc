<h1 class="page-name">Create Account</h1>
<p class="page-description">Please fill the form</p>
<?php include_once __DIR__."/../templates/alerts.php"; ?>
<form class="form" action="/create-account" method="POST">
    <div class="field">
        <label for="name" >name</label>
        <input type="text" name="name" id="name" class="input" placeholder="name" value="<?php echo s($user->name); ?>">
    </div>
    <div class="field">
        <label for="lastname" >lastname</label>
        <input type="text" name="lastname" id="lastname" class="input" placeholder="lastname" value="<?php echo s($user->lastname); ?>">
    </div>
    <div class="field">
        <label for="phone" >phone</label>
        <input type="tel" name="phone" id="phone" class="input" placeholder="phone" value="<?php echo s($user->phone); ?>">
    </div>
    <div class="field">
        <label for="email" >email</label>
        <input type="email" name="email" id="email" class="input" placeholder="email" value="<?php echo s($user->email); ?>">
    </div>
    <div class="field">
        <label for="password" >password</label>
        <input type="password" name="password" id="password" class="input" placeholder="password">
    </div>
    <input type="submit" value="save" class="button">
</form>
<div class="actions">
    <a href="/">Start Session</a>
    <a href="/forgot">Forgot Password</a>
</div>