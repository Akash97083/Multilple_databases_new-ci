<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$flag = true;

include_once('class/utcpro.class.php');
include_once('class/utcpro.settings.php');

$img = filter_input(INPUT_GET, 'img', FILTER_SANITIZE_STRING);

$set = filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);
if (isset($set)) {
    if (array_key_exists($set, $settings)) {
	foreach ($settings[$set] as $name => $value) {
	    $$name = $value;
	}
    }
} else {
    $mode	 = filter_input(INPUT_GET, 'mode', FILTER_SANITIZE_STRING);
    $w	 = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
    $h	 = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
    $bw	 = (int) filter_input(INPUT_GET, 'bw', FILTER_SANITIZE_NUMBER_INT);
    /*
     * hardcode $wm if you ant to keep your files protected
     * i.e. use $wm = 1;
     */
    $wm	 = filter_input(INPUT_GET, 'wm', FILTER_SANITIZE_NUMBER_INT);
    /*
     * hardcode $wmp if you want to prevent user from generating two images with different wmp settings
     * i.e. use something like $wmp = 'cover';, $wmp = 'cc'; or any other watermark position setting
     */
    $wmp	 = filter_input(INPUT_GET, 'wmp', FILTER_SANITIZE_STRING);
}

if (!validateFilePath($img)) {
    $flag = false;
}

if (isset($w) && isset($h) && $flag === true) {
    new utcPro($img, $mode, $w, $h, $bw, $wm, $wmp);
} else {
    header("HTTP/1.0 404 Not Found");
}

function validateFilePath($file) {
    $valid = true;
    
    if (substr($file,0,1) == '/') {
	$valid = false;
    } elseif (strpos($file,'../')) {
	$valid = false;
    } elseif (strpos($file,'://')) {
	$valid = false;
    }
    
    return $valid;
}
