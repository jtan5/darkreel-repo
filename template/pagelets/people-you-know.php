<?php

$feed_user_id = $feed_user->user_id;

$user_photo = $feed_user->avatar_url;
$user_url = $site['url'].'/profile.php?id='.$feed_user->user_id;
$user_full = $feed_user->first_name.' '.$feed_user->last_name;
$user_at = str_first_at($feed_user->username);

?>

<div class="post_block">
    <div class="post_viewer">
        <div class="row">
            <img src="<?php echo $user_photo; ?>" class="avatar" alt="">

            <div class="post_content">
                <div class="row_full">
                    <a href="<?php echo $user_url; ?>" class="user_name"><?php echo $user_full.' ('.$user_at.')'; ?></a>
                </div>
            
                <div class="row_full">
                    <?php 
                        if (is_logged_in() && $user->user_id != $feed_user_id) : 
                            $button_label = 'Follow';
                            $button_class = 'follow_user';
                            $button_isfollowing = 0;

                    ?>
                    <button class="follow_button <?php echo $button_class; ?>" data-isfollowing="<?php echo $button_isfollowing; ?>"<?php if (is_logged_in()) : ?> onclick="toggleFollowing(this, <?php echo $feed_user_id; ?>);"<?php else: ?> disabled<?php endif; ?>><?php echo $button_label; ?></button>
                    <?php endif; ?>
                </div>
                 
            </div>
        </div>    
     </div>
</div>