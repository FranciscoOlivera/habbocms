<?php
namespace Images\Extractor;

class ImageExtractor {
	public static $CachedImages;
	public static $NotFoundImg;
	
	public static function Init(){
		self::$CachedImages = [];
		
		self::$NotFoundImg = new ImageExtractItem("__NOTFOUND__", file_get_contents(IMG_NOTFOUND_SRC), "sprite");
		
	}
	
	public static function GetTexture($name, &$found = false){
		foreach(self::$CachedImages as $image){
			if($image->name == $name){
				$found = true;
				return $image->content;
			}
		}
		
		return self::GenerateTexture($name, $found);
	}
	
	public static function GetSprite($name, &$found = false){
		foreach(self::$CachedImages as $image){
			if($image->name == $name && $image->type == "sprite"){
				$found = true;
				return $image->content;
			}
		}
		
		return self::GenerateSprite($name, $found);
	}
	
	public static function LogImageNotFound($name){
		$content = file_exists(LOG_FURNI_NOT_FOUND) ? file_get_contents(LOG_FURNI_NOT_FOUND) : "";
		$content .= "\r\nFile not found: $name";
		file_put_contents(LOG_FURNI_NOT_FOUND, $content);
	}
	
	public static function GenerateSprite($name, &$found = false){
		$glob;
		if(FILE_OUTPUT_ENAMED_FOLDER)
			$glob = glob(SPRITE_PATH . "*/$name.png");
		else
			$glob = glob(SPRITE_PATH . "$name.png");
		if(count($glob) == 0){
			self::LogImageNotFound(SPRITE_PATH . $name);
			return self::$NotFoundImg->content;
		}
		
		$content = file_get_contents($glob[0]);
		self::$CachedImages[] = new ImageExtractItem($name, $content, "sprite");
		
		return $content;
	}
	
	
	public static function GenerateTexture($name, &$found = false){
		$glob;
		if(FILE_OUTPUT_ENAMED_FOLDER)
			$glob = glob(TEXTURE_PATH . "*/$name.png");
		else
			$glob = glob(TEXTURE_PATH . "$name.png");
		
		if(count($glob) == 0){
			self::LogImageNotFound(TEXTURE_PATH . $name);
			return self::$NotFoundImg->content;
		}
		
		$content = file_get_contents($glob[0]);
		self::$CachedImages[] = new ImageExtractItem($name, $content, "texture");
		
		return $content;
	}
	
	public static function GetNameIdsArray($file_name, $idsnames){
		$arr = [];
		foreach($idsnames as $key => $item){
			$ex = explode("_", $item["name"]);
			array_shift($ex);
			$name = $item["name"]; //count($ex) > 1 ? implode("_", $ex) : $item["name"];
			$id = $item["id"];
			if(strlen($file_name) < strlen($name) && substr($name, 0, strlen($file_name)) == $file_name)
				$name = substr($name, strlen($file_name) + 1, strlen($name));
			
			$arr[] = [
				"id" => $id,
				"name" => $name
			];
		}
		
		return $arr;
	}
	
	public static function TryExtractSprites(){
		echo "<h1>Extract mode: Sprite</h1>";
		$sprswffiles = glob(SWF_EXTRACT_SPRITES_PATH . "*.swf", GLOB_MARK);
		//echo "<pre>";
		$index = 0;
		foreach($sprswffiles as $file){
			echo "<i>Extracting $file</i><br />";
			$idandnames = self::DumpSwfImages($file);
			$nameexp = explode("/", $file);
			$file_name = $nameexp[count($nameexp) - 1];
			$file_name = substr($file_name, 0, count($file_name) - 5);
			if(!is_dir(SPRITE_PATH . "$file_name") && FILE_OUTPUT_ENAMED_FOLDER)
				mkdir(SPRITE_PATH . "$file_name");
			foreach($idandnames as $key => $item){
				$ex = explode("_", $item["name"]);
				array_shift($ex);
				$name = $item["name"]; //count($ex) > 1 ? implode("_", $ex) : $item["name"];
				if(strlen($file_name) < strlen($name) && substr($name, 0, strlen($file_name)) == $file_name)
					$name = substr($name, strlen($file_name) + 1, strlen($name));
				
					//$name = substr($name, 0, strlen($file_name) - 1);
				$output = FILE_OUTPUT_ENAMED_FOLDER ? SWF_EXTRACT_IMAGE_SPRITE_OUTPUT_PATH . "$file_name/$name.png" : SWF_EXTRACT_IMAGE_SPRITE_OUTPUT_PATH . "$name.png";
				$extracted = self::ExtractSwfImages($file, $item["id"], $output);
				$id = $item["id"];
				if($extracted)
					echo "[$index] Extracted $name.png <br>";
				else
					echo "[$index] <b>Error extracting $name.png </b> <u> Maybe already exists a file with name $name.png </u><br>";
				$index++;
				flush();
				
			}
			echo "<i>$file Extracted</i><br />";
		}
		
	}
	
	public static function TryExtractFurnis(){
		echo "<h1>Extract mode: Furni</h1>";
		$sprswffiles = glob(SWF_EXTRACT_FURNITURE_PATH . "*.swf", GLOB_MARK);
		
		$sprswffiles2 = glob(SWF_EXTRACT_FURNITURE_PATH . "*/*.swf", GLOB_MARK);
		
		
		$sprswffiles3 = array_merge($sprswffiles, $sprswffiles2);
		//echo "<pre>";
		$index = 0;
		foreach($sprswffiles3 as $file){
			echo "<i>Extracting $file</i><br />";
			$idandnames = self::DumpSwfImages($file);
			$nameexp = explode("/", $file);
			$file_name = $nameexp[count($nameexp) - 1];
			$file_name = substr($file_name, 0, count($file_name) - 5);
			if(!is_dir(SPRITE_PATH . "$file_name") && FILE_OUTPUT_ENAMED_FOLDER)
				mkdir(SPRITE_PATH . "$file_name");
			foreach($idandnames as $key => $item){
				$ex = explode("_", $item["name"]);
				array_shift($ex);
				$name = $item["name"]; //count($ex) > 1 ? implode("_", $ex) : $item["name"];
				if(strlen($file_name) < strlen($name) && substr($name, 0, strlen($file_name)) == $file_name)
					$name = substr($name, strlen($file_name) + 1, strlen($name));
				
					//$name = substr($name, 0, strlen($file_name) - 1);
				$output = FILE_OUTPUT_ENAMED_FOLDER ? SWF_EXTRACT_IMAGE_SPRITE_OUTPUT_PATH . "$file_name/$name.png" : SWF_EXTRACT_IMAGE_SPRITE_OUTPUT_PATH . "$name.png";
				$extracted = self::ExtractSwfImages($file, $item["id"], $output);
				$id = $item["id"];
				if($extracted)
					echo "[$index] Extracted $name.png <br>";
				else
					echo "[$index] <b>Error extracting $name.png </b> <u> Maybe already exists a file with name $name.png </u><br>";
				$index++;
				flush();
				
			}
			echo "<i>$file Extracted</i><br />";
		}
		
	}
	
	public static function DumpSwfImages($filename){
		//$dumped = shell_exec(SHELL_EXTRACT_PATH . "swfextract " . $path . "HabboRoomContent.swf");
		$dumped = shell_exec(SHELL_EXTRACT_PATH . "swfextract " . $filename);
		$matches = []; // PNGs: ID(s) 1-8, 10, 12-42, 44-223, 225-255
		preg_match("/PNGs: ID\(s\) (.*)/", $dumped, $matches);// This above
		
		$ids = [];
		
		$idsArrayString = array_pop($matches);
		$idsArrayExplode = explode(", ", $idsArrayString);
		foreach($idsArrayExplode as $pids){ // Get the 1-8, 10, 12-42, 44-223, 225-255 in matches
			$ex = explode("-", $pids);
			$min = (int)$ex[0];
			$max = count($ex) > 1 ? (int)$ex[1] : $min + 1;
			
			for($i = $min; $i < $max; $i ++){
				$ids[] = $i;
			}
		}
		
		
		$idsAndNames = [];
		$dumped = shell_exec(SHELL_EXTRACT_PATH . "swfdump " . $filename);
		$matches = [];
		preg_match_all("/exports (.*) as \"(.*)\"/", $dumped, $matches);
		array_shift($matches);
		array_merge($matches[0], $matches[1]);
		foreach($ids as $key => $id){
			foreach($matches[0] as $regkey => $regid){
				if($id == $regid){
					$idsAndNames[] = [
						"id" => $id,
						"name" => $matches[1][$regkey]
					];
					continue;
				}
			}
		}
		
		return $idsAndNames;
		//self::ExtractSwfImage($idsAndNames, "$name", $path);
	}
	
	
	public static function ExtractSwfImages($swffilename, $id, $output){
		//foreach($Names as $item){
			//$ob->name = str_replace($swfname . '_', '', $ob->name);
			if(!file_exists($output)){
				shell_exec(SHELL_EXTRACT_PATH . "swfextract " . $swffilename . " -p $id -o " . $output);
				return true;
			}
			return false;
			
		//}
		
	}
	
	public static function TryExtractPalettes(){
		echo "<h1>Extract mode: Palette</h1>";
		if(isset($_GET["filename"])){
			$filename = SWF_EXTRACT_SPRITES_PATH . $_GET["filename"] . ".swf";
			if(!file_exists($filename))
			{
				echo "$filename not exists!";
				return;
			}
			
			$idandnames = self::DumpSwfBinaries($filename);
			
			$nameexp = explode("/", $filename);
			$file_name = $nameexp[count($nameexp) - 1];
			$file_name = substr($file_name, 0, count($file_name) - 5);
			if(!is_dir(SWF_EXTRACT_PALETTE_OUTPUT_PATH . "$file_name") && FILE_OUTPUT_ENAMED_FOLDER)
				mkdir(SWF_EXTRACT_PALETTE_OUTPUT_PATH . "$file_name");
			$newidsnamesarray = self::GetNameIdsArray($file_name, $idandnames);
			echo "<pre>";
			foreach($newidsnamesarray as $item){
				$id = $item["id"];
				$name = $item["name"];
				if($name == $file_name . "_assets")
				{
					echo $item["name"] . " found!, extracting...<br>";
					$output = FILE_OUTPUT_ENAMED_FOLDER ? SWF_EXTRACT_PALETTE_OUTPUT_PATH . "$file_name/$name.xml" : SWF_EXTRACT_PALETTE_OUTPUT_PATH . "$name.xml";
					$extracted = self::ExtractSwfBinaries($filename, $item["id"], $output);
					if($extracted)
						echo "done!<br>";
					else
						echo "Error Extracting $filename!<br>";
				}
			}
			
			return;
		}
		
		// For Multiple Files
		
		
		$sprswffiles = glob(SWF_EXTRACT_SPRITES_PATH . "*.swf", GLOB_MARK);
		//echo "<pre>";
		$index = 0;
		foreach($sprswffiles as $filename){
			echo "<i>Extracting $filename</i><br />";
			$idandnames = self::DumpSwfBinaries($filename);
			
			$nameexp = explode("/", $filename);
			$file_name = $nameexp[count($nameexp) - 1];
			$file_name = substr($file_name, 0, count($file_name) - 5);
			$newidsnamesarray = self::GetNameIdsArray($file_name, $idandnames);
			foreach($newidsnamesarray as $item){
				$id = $item["id"];
				$name = $item["name"];
				if($name == $file_name . "_assets")
				{
					if(!is_dir(SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name") && FILE_OUTPUT_ENAMED_FOLDER)
						mkdir(SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name");
					
					echo $item["name"] . " found!, extracting...<br>";
					$output = FILE_OUTPUT_ENAMED_FOLDER ? SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name/$name.xml" : SWF_EXTRACT_BINARY_OUTPUT_PATH . "$name.xml";
					$extracted = self::ExtractSwfBinaries($filename, $item["id"], $output);
					if($extracted)
						echo "done!<br>";
					else
						echo "Error Extracting $filename!<br>";
				}
				else
					echo "$name ... not found... keeping to search :)<br>";
				
				flush();
			}
		}
	}
	
	public static function TryExtractBinaries(){
		echo "<h1>Extract mode: Binary</h1>";
		if(isset($_GET["filename"])){
			$filename = SWF_EXTRACT_SPRITES_PATH . $_GET["filename"] . ".swf";
			if(!file_exists($filename))
			{
				echo "$filename not exists!";
				return;
			}
			
			$idandnames = self::DumpSwfBinaries($filename);
			
			$nameexp = explode("/", $filename);
			$file_name = $nameexp[count($nameexp) - 1];
			$file_name = substr($file_name, 0, count($file_name) - 5);
			if(!is_dir(SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name") && FILE_OUTPUT_ENAMED_FOLDER)
				mkdir(SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name");
			$index = 0;
			$newidsnamesarray = self::GetNameIdsArray($file_name, $idandnames);
			
			foreach($newidsnamesarray as $item){
				
				$name = $item["name"];
				$id = $item["id"];
				$output = FILE_OUTPUT_ENAMED_FOLDER ? SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name/$name.xml" : SWF_EXTRACT_BINARY_OUTPUT_PATH . "$name.xml";
				$extracted = self::ExtractSwfBinaries($filename, $item["id"], $output);
					$id = $item["id"];
					if($extracted)
						echo "[$index] Extracted $name.xml to " . SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name/$name.xml" . "<br>";
					else
						echo "[$index] <b>Error extracting $name.xml </b> <u> Maybe already exists a file with name $name.png </u><br>";
					$index++;
					flush();
				echo "<i>$file Extracted</i><br />";
			}
			
			return;
		}
		
		// For Multiple Files
		
		
		$sprswffiles = glob(SWF_EXTRACT_SPRITES_PATH . "*.swf", GLOB_MARK);
		//echo "<pre>";
		$index = 0;
		foreach($sprswffiles as $file){
			echo "<i>Extracting $file</i><br />";
			$idandnames = self::DumpSwfBinaries($file);
			
			$nameexp = explode("/", $file);
			$file_name = $nameexp[count($nameexp) - 1];
			$file_name = substr($file_name, 0, count($file_name) - 5);
			if(!is_dir(SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name") && FILE_OUTPUT_ENAMED_FOLDER)
				mkdir(SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name");
			
			$newidsnamesarray = self::GetNameIdsArray($file_name, $idandnames);
			
			foreach($newidsnamesarray as $item){
				
				$name = $item["name"];
				$id = $item["id"];
				$output = FILE_OUTPUT_ENAMED_FOLDER ? SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name/$name.xml" : SWF_EXTRACT_BINARY_OUTPUT_PATH . "$name.xml";
				$extracted = self::ExtractSwfBinaries($file, $item["id"], $output);
					$id = $item["id"];
					if($extracted)
						echo "[$index] Extracted $name.xml to " . SWF_EXTRACT_BINARY_OUTPUT_PATH . "$file_name/$name.xml" . "<br>";
					else
						echo "[$index] <b>Error extracting $name.xml </b> <u> Maybe already exists a file with name $name.png </u><br>";
					$index++;
					flush();
				echo "<i>$file Extracted</i><br />";
			}
		}
	}
	
	public static function DumpSwfBinaries($filename){
		//$dumped = shell_exec(SHELL_EXTRACT_PATH . "swfextract " . $path . "HabboRoomContent.swf");
		$dumped = shell_exec(SHELL_EXTRACT_PATH . "swfextract " . $filename);
		$matches = []; // PNGs: ID(s) 1-8, 10, 12-42, 44-223, 225-255
		preg_match("/Binarys: ID\(s\) (.*)/", $dumped, $matches);// This above
		
		$ids = [];
		
		$idsArrayString = array_pop($matches);
		$idsArrayExplode = explode(", ", $idsArrayString);
		foreach($idsArrayExplode as $pids){ // Get the 1-8, 10, 12-42, 44-223, 225-255 in matches
			$ex = explode("-", $pids);
			$min = (int)$ex[0];
			$max = count($ex) > 1 ? (int)$ex[1] : $min + 1;
			
			for($i = $min; $i < $max; $i ++){
				$ids[] = $i;
			}
		}
		
		
		$idsAndNames = [];
		$dumped = shell_exec(SHELL_EXTRACT_PATH . "swfdump " . $filename);
		$matches = [];
		preg_match_all("/exports (.*) as \"(.*)\"/", $dumped, $matches);
		array_shift($matches);
		array_merge($matches[0], $matches[1]);
		foreach($ids as $key => $id){
			foreach($matches[0] as $regkey => $regid){
				if($id == $regid){
					$idsAndNames[] = [
						"id" => $id,
						"name" => $matches[1][$regkey]
					];
					continue;
				}
			}
		}
		
		return $idsAndNames;
		//self::ExtractSwfImage($idsAndNames, "$name", $path);
	}
	
	
	public static function ExtractSwfBinaries($swffilename, $id, $output){
		if(!file_exists($output)){
			echo shell_exec(SHELL_EXTRACT_PATH . "swfextract " . $swffilename . " -b $id -o " . $output);
			return true;
		}
		return false;
	}
	
	
	
	
}

ImageExtractor::Init();