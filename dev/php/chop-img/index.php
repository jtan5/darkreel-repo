<?php

$mario_sprite = 'full-sprite.png';

$img = imagecreatefrompng($mario_sprite);
imagealphablending($img, false);
imagesavealpha($img, true);

for ($i = 0; $i < 12; $i++) {
    $split = $i * 480;
    $resource = imagecrop($img, ['x' => $split, 'y' => 0, 'width' => 480, 'height' => 360]);
    
    $new_file_name = '1-1-'.($i + 1).'.png';
    imagepng($resource, $new_file_name);
}

?>