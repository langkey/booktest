<?php
$random = rand(1000,9999);
$im = imagecreatetruecolor(100, 38);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 0, 0, $black);
$font = dirName(__FILE__) . '/font/day_cyr.ttf';
imagettftext($im, 25, 5, 15, 30, $white, $font, $random);
	header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");//защита от кеширования
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");//защита от кеширования
	header("Cache-Control: no-store, no-cache, must-revalidate");//защита от кеширования
	header("Cache-Control: post-check=0, pre-check=0", false);//защита от кеширования
	header("Pragma: no-cache");
	header("Content-type: image/gif");
imagegif($im);
imagedestroy($im);
?>