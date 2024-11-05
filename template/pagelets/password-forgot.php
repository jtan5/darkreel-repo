<p>Forgot your password? Enter your email address and we'll send you a link to reset it.</p>
            
<form action="<?php echo $site['url_process']; ?>/password-forgot.php" method="post">
    <label for="email_address">Email address</label>
    <input id="email_address" name="email_address" type="text" placeholder="Email address">

    <input type="submit" class="wide_butt" value="Send Email">
</form>  