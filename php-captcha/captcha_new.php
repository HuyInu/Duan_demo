<?php
session_start();

header('Content-Type: image/png');
$width = 120;//(strlen($input_text)*9)+80;
$height = 50;
$im = imagecreatetruecolor($width, $height);
// Create some colors
$white = imagecolorallocate($im, 223, 223, 223);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 34, 34, 34);
imagefilledrectangle($im, 0, 0, $width, $height, $white);
// The text to draw
$text = $_SESSION['codesecurity'] = rand(11111, 99999);
// Replace path by your own font path
$font = dirname(__FILE__).'/fonts/monofont.ttf';
// Add some shadow to the text
//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
// Add the text
// image source, size, độ xoay, x, y, màu, font, text
imagettftext($im, 35, -3, 12, 38, $black, $font, $text);
// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>