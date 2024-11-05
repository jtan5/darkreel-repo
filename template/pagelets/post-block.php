<?php

$post_id = $post->post_id; 
$feed_user_id = $feed_user->user_id;

$user_photo = $feed_user->avatar_url;
$user_url = $site['url'].'/profile.php?id='.$feed_user_id;
$user_full = $feed_user->first_name.' '.$feed_user->last_name;
$user_at = str_first_at($feed_user->username);
$user_safe = str_html_safe_echo($user_full.' ('.$user_at.')');

$photo_url = '';
if (isset($photo)) {
	$photo_url = $site['url_content'].'/'.$photo->photo_url;
}


$post_copy = str_post_copy_formatter($post->post_copy);
$post_copy_safe = str_html_safe_echo($post->post_copy);

?>

<div id="post_<?php echo $post_id; ?>" class="post_block post_<?php echo $post_id; ?>" data-aos="fade-up">
    <div class="post_viewer">
        <div class="row">
            <img src="<?php echo $user_photo; ?>" class="avatar" alt="<?php echo $user_safe; ?>">

            <div class="post_content">
                <div class="row_full">
                    <a href="<?php echo $user_url; ?>" class="user_name"><?php echo $user_full.' ('.$user_at.')'; ?></a>

                    <?php if ($user->user_id == $feed_user_id) : ?>
                    <a onclick="deletePost(<?php echo $post_id; ?>);" class="delete">&times;</a>
                    <?php endif; ?>
                </div>
                
                <?php if ($post_copy) : ?>
				<p><?php echo $post_copy; ?></p>
                <?php endif; ?>
				
                <?php if ($photo_url) : ?>
                <img src="<?php echo $photo_url; ?>" class="attachment" alt="<?php echo $post_copy_safe; ?>">
                <?php endif; ?>
            </div>
        </div>    
     </div>
</div>