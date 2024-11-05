
<div id="login_form">
	<h2>Login</h2>
	
	<form action="<?php echo $site['url_process']; ?>/do-login.php" method="post">
        <label for="email_address">Email address</label>
		<input name="email_address" type="text" placeholder="email@example.com">
        
        <label for="password">Password</label>
		<input id="password" name="password" type="password" placeholder="Password">
		
		<button>Login</button>
	</form>
	
	<a href="<?php echo $site['url']; ?>/password.php">Forgot password?</a>
</div>