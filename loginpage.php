<div class="outer">
<div class="wrap">
	<div class="login-block">
		<h1>TEST: <?php echo $_SESSION['userid']; ?></h1>
<h2 class="title">Login</h2>
<form action="login.php" method="post" class="form">
<p><label class="label" for="email">Email Address:</label>
<input id="email" type="text" name="email" size="30" maxlength="60" 
value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>

<p><label class="label" for="password">Password:</label>
<input id="psword" type="password" name="password" size="12" maxlength="12" 
value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" > 

<p><input id="submit" type="submit" name="submit" value="Login"> or <a href="signup.php">Signup</a></p>
</form>
</div>
</div>
</div>