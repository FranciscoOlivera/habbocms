<?php
include_once "Init.php";
use Images\Image;
use Images\Extractor\ImageExtractor;
/*
	Mod version
	Stage 1: Planes
		
*/

session_start();
$mode = "set"; // Set or get

if(isset($_GET["mode"]))
	$mode = $_GET["mode"];

$content = file_get_contents("php://input");

if($mode == "set"){
	$_SESSION["picdata"] = $content;
}
else{
	if(isset($_SESSION["picdata"]) && isset($_GET["name"]))
	{
		$image = new Image();
		$overimg = new Image();
		
		$image->SetImageFromContentString($_SESSION["picdata"]);
		
		$overimg->SetImageFromFile("overmarks");
		//$overimg->Opacity(0.2);
		
		$image->PasteImage($overimg, $image->width - $overimg->width - 10, 10);
		
		$name = $_GET["name"];
		$image->SaveAt("pictures/$name.png");
		
		unset($_SESSION["picdata"]);
		header("Location: pictures/$name.png");
		//header('Content-type: image/png');
		//$image->ShowImage();
	}
	
}
