<?php

namespace Log;

class LogManager {
	public static function LogDrawingStepText($text){
		if(isset($_GET["showsteptext"]))
		{
			echo $text;
			flush();
		}
	}
	
	public static function LogDrawingImage($image){
		if(isset($_GET["showstepimage"])){
			ob_start();
			imagepng($image->source);
			$imgbase64 = base64_encode(ob_get_contents());
			ob_end_clean();
			
			
			echo "<img src='data:image/png;base64,$imgbase64' /><br>";
			flush();
			
		}
	}
}