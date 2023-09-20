<?php
include_once "../Init.php";
use Images\Image;
use Images\Extractor\ImageExtractor;
/*
	Mod version
	Stage 1: Planes
		
*/

session_start();
$roomid = 0; // Set or get

if(isset($_GET["roomid"]))
	$roomid = $_GET["roomid"];

$content = file_get_contents("php://input");
$image = new Image();
$image->SetImageFromContentString($content);

$image->SaveAt("$roomid.png");






















