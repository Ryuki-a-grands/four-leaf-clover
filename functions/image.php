<?php
// Create png file at change color.
function four_leaf_clover_image_create($change_r=192,$change_g=224,$change_b=181){
	if(four_leaf_clover_gd_library_active()){
		$im = imagecreatefrompng(get_template_directory_uri().'/images/default/four-leaf-clover.png');
		$search=imagecreatefrompng(get_template_directory_uri().'/images/default/search.png');
		imagefilter($im, IMG_FILTER_COLORIZE, $change_r, $change_g, $change_b);
		imagecopy($im, $search, 800, 91, 0, 0, 29, 28);
		imagecolortransparent($im, imagecolorallocate($im, 255, 255, 255));
		imagepng($im, get_template_directory().'/images/four-leaf-clover.png',9);
		imagedestroy($im);
		imagedestroy($search);
	}
}
// Change the hex to rgb.
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}