<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);

function hexToRgb($hex) {
    // Remove the hash if it exists
    $hex = ltrim($hex, '#');

    // If the hex code is 3 digits, expand it to 6 digits
    if (strlen($hex) == 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    // Convert the hex code to RGB values
    $rgb = [
        'r' => hexdec(substr($hex, 0, 2)),
        'g' => hexdec(substr($hex, 2, 2)),
        'b' => hexdec(substr($hex, 4, 2))
    ];

    return $rgb;
}


// Function to extract CSS variable value
function getCssVariableValue($css_content, $variable_name) {
    // Create a regular expression to find the variable and its value
    $pattern = '/'.$variable_name.'\s*:\s*([^;]+);/i';

    // Search for the variable in the CSS content
    if (preg_match($pattern, $css_content, $matches)) {
        // Return the value of the CSS variable
        return trim($matches[1]);
    }

    // Return null if the variable is not found
    return null;
}

// Read the contents of the CSS file
$css_file = '../../../css/style.css';
$css_content = file_get_contents($css_file);

// Extract the value of the CSS variable --main-color
$main_color = getCssVariableValue($css_content, '--main-hex');

// Set the PNG file path and background colour
$pngFile = 'outline.png';
$canvasSize = 600; // Set the square size (e.g., 500x500 pixels)

$backgroundColor = hexToRgb($main_color); //0000CC'); // Hex colour for the background (e.g., red)

// Create a new true color image with the square canvas size
$canvas = imagecreatetruecolor($canvasSize, $canvasSize);

// Allocate the background color
$bgColor = imagecolorallocate($canvas, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);

// Fill the canvas with the background color
imagefill($canvas, 0, 0, $bgColor);

// Load the transparent PNG
$pngImage = imagecreatefrompng($pngFile);

// Get the dimensions of the PNG image
$pngWidth = imagesx($pngImage);
$pngHeight = imagesy($pngImage);

// Calculate the position to center the PNG on the canvas
$xPos = ($canvasSize - $pngWidth) / 2;
$yPos = ($canvasSize - $pngHeight) / 2;

// Place the PNG image onto the canvas without transparency (because JPG does not support transparency)
imagecopy($canvas, $pngImage, $xPos, $yPos, 0, 0, $pngWidth, $pngHeight);

// Set the content type header for JPEG
header('Content-Type: image/jpeg');

// Output the final image as a JPEG
imagejpeg($canvas, null, 100); // The 100 here indicates the highest quality for JPEG

// Clean up
imagedestroy($canvas);
imagedestroy($pngImage);

?>