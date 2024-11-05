<div id="post_creator">
    <div id="post_blackout">
        Uploading...
    </div>
    
    <form id="post_new" action="process/post-new.php" method="post" enctype="multipart/form-data" onsubmit="return AIM.submit(this, {'onStart': postStart, 'onComplete': postComplete});">
        <input name="MAX_UPLOAD_SIZE" type="hidden" value="157286400">
        
        <div class="post_composer">
            <div class="row">
                <div><img src="<?php echo $user->avatar_url; ?>" alt="<?php echo str_html_safe_echo($user->first_name); ?>"></div>

                <textarea name="post" class="required" placeholder="Write something..."></textarea>
            </div>    
            
            <div class="row right">
                <input name="media" class="file required" type="file" value="">
                
                <input type="submit" class="post" value="Post">
            </div>
        </div>
    
    </form>
</div>