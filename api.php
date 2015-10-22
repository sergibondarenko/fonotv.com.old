<?php

include 'php/functions.php';

$pageUrl = $_POST['url'];
$dbFile = 'json/coubs.json';

$html = remote_get_contents($pageUrl);

$pageUrl = get_coub_video_link($html, $pageUrl);

if(file_exists($dbFile)){
	$videoJson = file_get_contents($dbFile, LOCK_EX);
	$videoArray = json_decode($videoJson, true);
	$newEid = count($videoArray);
} else {
	$newEid = 0;
} 

$videoArray[$newEid]["file"] = $pageUrl;

file_put_contents($dbFile, json_encode($videoArray), LOCK_EX);
//file_put_contents($dbFile, $pageUrl.PHP_EOL, FILE_APPEND | LOCK_EX);

?>