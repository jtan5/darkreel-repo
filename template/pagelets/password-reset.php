<p>We've successfully verified your email address. Please enter a new password and we'll log you in automatically.</p> 

<form action="<?php echo $site['url_process']; ?>/password-reset.php" method="post">
    <input id="prc1" name="prc1" type="hidden" value="<?php echo $rqst['prc1']; ?>">
    <input id="prc2" name="prc2" type="hidden" value="<?php echo $rqst['prc2']; ?>">

    <label for="new_password">New password</label>
    <input id="new_password" name="new_password" type="text">

    <label for="new_password_confirm">Confirm new password</label>
    <input id="new_password_confirm" name="new_password_confirm" type="text">

    <input type="submit" class="wide_butt" value="Reset Password">
</form>  