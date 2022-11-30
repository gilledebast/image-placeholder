<?php 
	
	header("Access-Control-Allow-Origin: *");
	
	$w = $_GET["w"] ?? 100;
	$h = $_GET["h"] ?? 100;
	$f = $_GET["f"] ?? 'png';

	if($f == 'png'){
		header("Content-type: image/png");
	} else if($f == 'jpg'){
		header("Content-type: image/jpeg");
	} else if($f == 'webp'){
		header("Content-type: image/webp");
	}
	
	// Create image
	$image = imagecreate($w, $h);

	$color = array(200, 200, 200);
	imagecolorallocate($image, $color[0], $color[1], $color[2]);

	// Text
	$text = $w."x".$h;
	
	// Text color ?
	$tColor = imagecolorallocate($image, 0,0,0);

	// Text positioning
	$fontsize   = 4;
	$fontwidth  = imagefontwidth($fontsize);    // width of a character
	$fontheight = imagefontheight($fontsize);   // height of a character
	$length     = strlen($text);                // number of characters
	$textwidth  = $length * $fontwidth;         // text width
	$xpos       = (imagesx($image) - $textwidth) / 2;
	$ypos       = (imagesy($image) - $fontheight) / 2;

	// Generate text
	imagestring($image, $fontsize, $xpos, $ypos, $text, $tColor);

	// Render image
	if($f == 'png'){
		imagepng($image);
	} else if($f == 'jpg'){
		imagejpeg($image);
	} else if($f == 'webp'){
		imagewebp($image);
	}

?>