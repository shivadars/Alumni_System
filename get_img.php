<?php
$size = getimagesize('public/images/hero-bg.png');
if ($size) {
    echo "Width: " . $size[0] . ", Height: " . $size[1] . "\n";
} else {
    echo "Error: Could not get image size.\n";
}
