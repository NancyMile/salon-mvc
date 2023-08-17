<h1 class="page-name">Create Account</h1>
<p class="page-description">Please fill the form</p>
<form class="form" action="/create-account" method="$_POST">
    <div class="field">
        <label for="name" >name</label>
        <input type="text" name="name" id="name" class="input" placeholder="name">
    </div>
    <div class="field">
        <label for="lastname" >lastname</label>
        <input type="text" name="lastname" id="lastname" class="input" placeholder="lastname">
    </div>
    <div class="field">
        <label for="phone" >phone</label>
        <input type="tel" name="phone" id="phone" class="input" placeholder="phone">
    </div>
    <div class="field">
        <label for="email" >email</label>
        <input type="email" name="email" id="email" class="input" placeholder="email">
    </div>
    <div class="field">
        <label for="password" >password</label>
        <input type="password" name="password" id="password" class="input" placeholder="password">
    </div>
    <input type=submit" value="save" class="button">
</form>
<div class="actions">
    <a href="/">Start Session</a>
    <a href="/forgot">Forgot Password</a>
</div>