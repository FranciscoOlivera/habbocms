<?php
namespace Images;

use Polygons\PolygonManager;
use Sprites\SpriteManager;
use Log\LogManager as Log;
class Image {
	public $source;
	
	public $PolygonManager;
	public $SpriteManager;
	
	public $width;
	public $height;
	
	public $angle;
	public $Drawned;
	
	public $Destroyed;
	
	public $Src;
	
	public $imageBytes;
	
	public function __construct($w = 1, $h = 1){
		$this->width = $w > 0 ? $w : 1;
		$this->height = $h > 0 ? $h : 1;
		$this->angle = 0;
		$this->Drawned = false;
		$this->imageBytes = null;
		$this->source = imagecreatetruecolor($this->width, $this->height);
		$this->PolygonManager = new PolygonManager($this);
		$this->SpriteManager = new SpriteManager($this);
		$this->Destroyed = false;
		
		self::$CachedImages[] = $this;
	
	
	}
	
	public function __destruct(){
		$this->Destroy();
	}
	
	public function ShowImage(){
		$this->Draw();
		
		echo $this->GetImageBytes();
	}
	
	public function GetImageBytes(){
		if($this->imageBytes == null){
			ob_start();
			imagepng($this->source, null, 9);
			$c = ob_get_contents();
			ob_get_clean();
			$this->imageBytes = $c;
		}
		
		return $this->imageBytes;
	}
	
	public function SaveAt($output){
		
		file_put_contents($output, $this->GetImageBytes());
	}
	
	public function Draw(){
		if($this->Drawned)
			return;
		
		$this->Drawned = true;
		
		if(isset($_GET["ShowStepText"]))
			echo "Drawing Polygons";
		$this->PolygonManager->DrawPolygons();
		
		if(isset($_GET["ShowStepText"]))
			echo "Drawing Textures";
		$this->PolygonManager->DrawTextures();
		
		if(isset($_GET["ShowStepText"]))
			echo "Drawing Sprites";
		$this->SpriteManager->DrawSprites();
	}
	
	public function SetBg($image){
		for($x = 0; $x < $image->width - $this->width; $x += $this->width)
			for($y = 0; $y < $image->height - $this->height; $y += $this->height)
				imagecopy($image->source, $this->source, $x, $y, 0, 0, $this->width, $this->height);
	}
	
	public function SetBgColor($r, $g, $b){
		$oldimg = $this->source;
		$newimg = new Image($this->width, $this->height);
		$newimg->DrawRect(0, 0, $this->width, $this->height, $newimg->GetColor($r, $g, $b));
		$newimg->PasteImage($this, 0, 0);
		$this->Destroy(true);
		$this->source = $newimg->source;
		/*$newimg = imagecreatetruecolor($this->width, $this->height);
		$this->source = $newimg;
		$this->*/
	}
		
	public function Destroy($recreate = false){
		if(!$this->Destroyed)
			imagedestroy($this->source);
		if(!$recreate){
			$this->Destroyed = true;
		}
	}
	
	public function SetTile($image){
		imagesettile($this->source, $image->source);
	}
	
	public function SetImageFromFile($src){
		if(!file_exists($src))
			return;
		$this->Destroy(true);
		$ex = explode(".", $src);
		$extension = $ex[count($ex) - 1];
		switch($extension){
			case "png":
			default:
				$this->source = imagecreatefrompng($src);
			break;
			
			case "gif":
				$this->source = imagecreatefromgif($src);
			break;
		}
		$this->width = imagesx($this->source);
		$this->height = imagesy($this->source);
		$this->FlushTransparency();
		$this->Src = $src;
	}
	
	public function SetImageFromContentString($content, $name = ""){
		$this->Destroy(true);
		$this->source = imagecreatefromstring($content);
		$this->width = imagesx($this->source);
		$this->height = imagesy($this->source);
		$this->Src = $name;
		//$this->FlushTransparency();
	}
	
	public function PasteImage($image, $x, $y){
		imagecopy($this->source, $image->source, $x, $y, 0, 0, $image->width, $image->height);
	}
	
	public function PasteImageWithMasks($image, $startX, $startY, $masks){
		//$this->RemoveTransparency();
		for($x = $startX; $x < $this->width - 1; $x++)
			for($y = $startY; $y < $this->height - 1; $y++){
				
				if($x - $startX >= $image->width || $y - $startY >= $image->height)
					continue;
				$imageColorIndex = imagecolorat($image->source, $x - $startX, $y - $startY);
				$imagergb = imagecolorsforindex($image->source, $imageColorIndex);
				
				$blacklevel = ((($imagergb["red"] + $imagergb["green"] + $imagergb["blue"])));
				if($blacklevel == 0)
					continue;
				
				//$sourceColorIndex = imagecolorat($this->source, $x, $y);
				//$sourcergb= imagecolorsforindex($this->source, $sourceColorIndex);
				//echo "<b>BlackLevel = $blacklevel</b>";
				$color = imagecolorallocatealpha($this->source, $imagergb["red"], $imagergb["green"], $imagergb["blue"], $imagergb["alpha"]);
				
				imagesetpixel($this->source, $x, $y, $color);
			}
	}
	
	public function AddImage($image){
		$this->ImagePaste->Add($image);
	}
	
	public function DrawPolygon($poly, $color){
		imagefilledpolygon($this->source, $poly, count($poly) / 2, $color);
	}
	
	public function DrawRect($x, $y, $w, $h, $color){
		imagefilledrectangle($this->source, $x, $y, $x + $w, $y + $h, $color);
	}
	
	
	
	####Modeling
	public function Resize($w, $h){
		$oldimg = $this->source;
		$newimg = imagecreatetruecolor($w, $h);
		imageantialias($newimg, true);
		imagecopyresized($newimg, $this->source, 0, 0, 0, 0, $w, $h, $this->width, $this->height);
		$this->source = $newimg;
		$this->width = $w;
		$this->height = $h;
		imagedestroy($oldimg);
		
	}
	
	
		
	public function Rotate($g){
		$oldimg = $this->source;
		$this->source = imagerotate($oldimg, $g, imagecolorallocatealpha($oldimg, 0, 0, 0, 127), 0);
		$this->width = imagesx($this->source);
		$this->height = imagesy($this->source);
		imagedestroy($oldimg);
	}
	
	public function Crop($x, $y, $w, $h){
		$oldimg = $this->source;
		$newimg = imagecreatetruecolor($w, $h);
		imagecopy($newimg, $oldimg, 0, 0, $x, $y, $w, $h);
		$this->width = $w;
		$this->height = $h;
		imagedestroy($oldimg);
		$this->source = $newimg;
	}
	
	public function FlipH(){
		
		imageflip($this->source, IMG_FLIP_HORIZONTAL);
	}
	
	public function SetTransparency($r,$g, $b){
		imagecolortransparent($this->source, $this->GetColor($r, $g, $b));
	}
	
	public function RemoveTransparency(){
		imagealphablending($this->source, false);
		imagesavealpha($this->source, true);
	}
	
	public function FlushTransparency(){
		imagealphablending($this->source, true);
		imagesavealpha($this->source, true);
		
	}
	
	
	####Color 
	public function SetAlpha($i){
		//imagefilter($this->source, IMG_FILTER_NEGATE); 
		imagefilter($this->source, IMG_FILTER_COLORIZE, 0, 0, 0, $i); 
		//imagefilter($this->source, IMG_FILTER_NEGATE); 
	}
	public function AddContrast($i){
		
		imagefilter($this->source, IMG_FILTER_BRIGHTNESS, $i);
	}
	
	
	public function BlendAdd($image, $sourceX, $sourceY){
		$totalColors = imagecolorstotal($image->source);
		
		for($x = 0; $x < $image->width; $x++)
			for($y = 0; $y < $image->height; $y++){
				if($sourceX + $x < 0 || $sourceX + $x > $this->width || $sourceY + $y < 0 || $sourceY + $y > $this->width)
					continue;
				
				$rgbindex = imagecolorat($image->source, $x, $y);
				
				if($rgbindex < 0 && !imagecolortransparent($image->source))
					continue;
				
				$rgb = imagecolorsforindex($image->source, $rgbindex);
				
				$sourceregbindex = imagecolorat($this->source, $sourceX + $x, $sourceY + $y);
				$sourcergb = imagecolorsforindex($this->source, $sourceregbindex);
				
				$newR = min(255, $rgb["red"] + $sourcergb["red"]);
				$newG = min(255, $rgb["green"] + $sourcergb["green"]);
				$newB = min(255, $rgb["blue"] + $sourcergb["blue"]);
				
				$newcolor = imagecolorallocate($this->source, $newR, $newG, $newB);
				
				imagesetpixel($this->source, $sourceX + $x, $sourceY + $y, $newcolor);
			}
	}
	
	public function AddMask($image, $startX, $startY){
		//Log::LogDrawingStepText("Draw to");
		//Log::LogDrawingImage($this);
		Log::LogDrawingStepText("<b>Source size: $this->width x $this->height for start in $startX - $startY</b>");
		Log::LogDrawingStepText("<b>Image size: $image->width x $image->height for start in $startX - $startY</b>");
		//Log::LogDrawingImage($image);
		for($x = $startX; $x < $this->width - 1; $x++)
			for($y = $startY; $y < $this->height - 1; $y++){
				if($x - $startX >= $image->width || $y - $startY >= $image->height)
					continue;
				$imageColorIndex = imagecolorat($image->source, $x - $startX, $y - $startY);
				$imagergb = imagecolorsforindex($image->source, $imageColorIndex);
				
				$blacklevel = 127 - ((765 - ($imagergb["red"] + $imagergb["green"] + $imagergb["blue"])) / 127);
				
				$sourceColorIndex = imagecolorat($this->source, $x, $y);
				$sourcergb= imagecolorsforindex($this->source, $sourceColorIndex);
				//echo "<b>BlackLevel = $blacklevel</b>";
				$color = imagecolorallocatealpha($this->source, $imagergb["red"], $imagergb["green"], $imagergb["blue"], $blacklevel);
				$color2 = imagecolortransparent($this->source, $color);
				
				imagesetpixel($this->source, $x, $y, $color);
				
			}
	}
	
	function SetPixelOpacity($x, $y, $opacity){
		$color = imagecolorat( $imageDst, $x, $y );
		$alpha = 127 - ( ( $color >> 24 ) & 0xFF );
		if ( $alpha > 0 ) {
			$color = ( $color & 0xFFFFFF ) | ( (int)round( 127 - $alpha * $opacity ) << 24 );
			imagesetpixel( $imageDst, $x, $y, $color );
		}
	}
	
	function Opacity($opacity)
	{
		// Duplicate image and convert to TrueColor
		$imageDst = imagecreatetruecolor( $this->width, $this->height );
		imagealphablending( $imageDst, false );
		imagefill( $imageDst, 0, 0, imagecolortransparent( $imageDst ) );
		imagecopy( $imageDst, $this->source, 0, 0, 0, 0, $this->width, $this->height );

		// Set new opacity to each pixel
		for ( $x = 0; $x < $this->width; ++$x )
			for ( $y = 0; $y < $this->height; ++$y ) {
				$color = imagecolorat( $imageDst, $x, $y );
				$alpha = 127 - ( ( $color >> 24 ) & 0xFF );
				if ( $alpha > 0 ) {
					$color = ( $color & 0xFFFFFF ) | ( (int)round( 127 - $alpha * $opacity ) << 24 );
					imagesetpixel( $imageDst, $x, $y, $color );
				}
			}

		$this->Destroy(true);

		$this->source = $imageDst;
	}
	
	
	
	
	function Saturation($saturationPercentage) {
		
		for($x = 0; $x < $this->width; $x++) {
			for($y = 0; $y < $this->height; $y++) {
				if($x < 0 || $x > $this->width || $y < 0 || $y > $this->height)
					continue;
				
				$rgb = imagecolorat($this->source, $x, $y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;            
				$alpha = ($rgb & 0x7F000000) >> 24;
				list($h, $s, $l) = $this->rgb2hsl($r, $g, $b);         
				$s = $s * (100 + $saturationPercentage ) /100;
				if($s > 1) $s = 1;
				list($r, $g, $b) = $this->hsl2rgb($h, $s, $l);            
				imagesetpixel($this->source, $x, $y, imagecolorallocatealpha($this->source, $r, $g, $b, $alpha));
			}
		}
	}
	
	function rgb2hsl($r, $g, $b) {
	   $var_R = ($r / 255);
	   $var_G = ($g / 255);
	   $var_B = ($b / 255);

	   $var_Min = min($var_R, $var_G, $var_B);
	   $var_Max = max($var_R, $var_G, $var_B);
	   $del_Max = $var_Max - $var_Min;

	   $v = $var_Max;

	   if ($del_Max == 0) {
		  $h = 0;
		  $s = 0;
	   } else {
		  $s = $del_Max / $var_Max;

		  $del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		  $del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		  $del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

		  if      ($var_R == $var_Max) $h = $del_B - $del_G;
		  else if ($var_G == $var_Max) $h = ( 1 / 3 ) + $del_R - $del_B;
		  else if ($var_B == $var_Max) $h = ( 2 / 3 ) + $del_G - $del_R;

		  if ($h < 0) $h++;
		  if ($h > 1) $h--;
	   }

	   return array($h, $s, $v);
	}

	function hsl2rgb($h, $s, $v) {
		if($s == 0) {
			$r = $g = $B = $v * 255;
		} else {
			$var_H = $h * 6;
			$var_i = floor( $var_H );
			$var_1 = $v * ( 1 - $s );
			$var_2 = $v * ( 1 - $s * ( $var_H - $var_i ) );
			$var_3 = $v * ( 1 - $s * (1 - ( $var_H - $var_i ) ) );

			if       ($var_i == 0) { $var_R = $v     ; $var_G = $var_3  ; $var_B = $var_1 ; }
			else if  ($var_i == 1) { $var_R = $var_2 ; $var_G = $v      ; $var_B = $var_1 ; }
			else if  ($var_i == 2) { $var_R = $var_1 ; $var_G = $v      ; $var_B = $var_3 ; }
			else if  ($var_i == 3) { $var_R = $var_1 ; $var_G = $var_2  ; $var_B = $v     ; }
			else if  ($var_i == 4) { $var_R = $var_3 ; $var_G = $var_1  ; $var_B = $v     ; }
			else                   { $var_R = $v     ; $var_G = $var_1  ; $var_B = $var_2 ; }

			$r = $var_R * 255;
			$g = $var_G * 255;
			$B = $var_B * 255;
		}    
		return array($r, $g, $B);
	}
	
	
	
	
	public function Recolor($r, $b, $g, $a = 255){
		
		$rgb = [255 - $r, 255 - $g, 255 - $b, 255 - $a];
		
		imagefilter($this->source, IMG_FILTER_NEGATE); 
		imagefilter($this->source, IMG_FILTER_COLORIZE, $rgb[0], $rgb[1], $rgb[2], $rgb[3]); 
		imagefilter($this->source, IMG_FILTER_NEGATE); 
		
		$this->FlushTransparency();
		
		/*for($x = 0; $x < $this->width; $x++)
			for($y = 0; $y < $this->width; $y++)
			$this->RecolorPixel($x, $y, $r, $g, $b);*/
	}
	
	public function GetColor($r,$g, $b){
		return imagecolorallocatealpha($this->source, $r, $g, $b, 1);
	}
	
	public function RecolorPixel($x, $y, $r, $g, $b){
		
        /*color = imagecolorsforindex($this->source, imagecolorat($this->source, $x, $y));//$rgb = imagecolorsforindex($image, (imagecolorat($image, $x, $y)));

        $newr = ($r / 255) * ($color['red']);
        $newg = ($g / 255) * ($color['green']);
        $newb = ($b / 255) * ($color['blue']);
        imagesetpixel($this->source, $x, $y, (imagecolorallocatealpha($this->source, $newr, $newg, $newb, $color['alpha'])));*/
		
		
	}
	
	##My Hero
	/*
	* Author @nchourrout https://github.com/nchourrout
	*/
	public function createPerspective(
		$x0,$y0,
		$x1,$y1,
		$x2,$y2,
		$x3,$y3,
		$bottonAlign = false
	){
			//The Max Width
			$SX = max($x0,$x1,$x2,$x3);
			
			//The Max Height
			$SY = max($y0,$y1,$y2,$y3);
			
			//Creates a new Image with Max Size
			$newImage = imagecreatetruecolor($SX, $SY);
			
			$bg_color=ImageColorAllocateAlpha($newImage,255,255,255, 127); 
			
			imagefill($newImage, 0, 0, $bg_color);
			
			if(!$bottonAlign){
				for ($y = 0; $y < $this->height; $y++) {
					for ($x = 0; $x < $this->width; $x++) {
						
						list($dst_x,$dst_y) = $this->corPix($x0,$y0,
															$x1,$y1,
															$x2,$y2,
															$x3,$y3,
															$x,$y,$this->width,$this->height);
						
						imagecopy($newImage, $this->source, $dst_x, $dst_y, $x, $y, 1,1);
						
					}
				}
			}
			else{
				for ($y = $this->height; $y >= 0; $y--) {
					for ($x = 0; $x < $this->width; $x++) {
						
						list($dst_x,$dst_y) = $this->corPix(
															$x0,$y0,
															$x1,$y1,
															$x2,$y2,
															$x3,$y3,
															$x,$y,$this->width,$this->height);
						
						imagecopy($newImage, $this->source, $dst_x, $dst_y, $x, $y, 1,1);
						
					}
				}
			}
			
			
			imagedestroy($this->source);
			$this->source = $newImage;
			$this->width = imagesx($this->source);
			$this->height = imagesy($this->source);
		}
		
		/*
		
		X4,Y4##############X1,Y1
			###############
			###############
			###############
			###############
			###############
		X3,Y3#############X2,Y2
		
		*/
		
		private function corPix($x0,$y0, $x1,$y1, $x2,$y2, $x3,$y3, $x,$y, $SX,$SY) {
			return $this->intersectLines(
				(($SY-$y)*$x0 + ($y)*$x3)/$SY, (($SY-$y)*$y0 + $y*$y3)/$SY,
				(($SY-$y)*$x1 + ($y)*$x2)/$SY, (($SY-$y)*$y1 + $y*$y2)/$SY,
				(($SX-$x)*$x0 + ($x)*$x1)/$SX, (($SX-$x)*$y0 + $x*$y1)/$SX,
				(($SX-$x)*$x3 + ($x)*$x2)/$SX, (($SX-$x)*$y3 + $x*$y2)/$SX);
		}
		private function det($a,$b,$c,$d) {
			return $a*$d-$b*$c;
		}
		private function intersectLines($x1, $y1,  $x2, $y2,  $x3, $y3,  $x4,$y4) {
			$d = $this->det($x1-$x2,$y1-$y2,$x3-$x4,$y3-$y4);
  
			if ($d==0) $d = 1;
  
			$px = $this->det($this->det($x1,$y1,$x2,$y2),
							$x1-$x2,
							$this->det($x3,$y3,$x4,$y4),
							$x3-$x4)/$d;
			
			$py = $this->det($this->det($x1,$y1,$x2,$y2), 
							$y1-$y2,
							$this->det($x3,$y3,$x4,$y4),
							$y3-$y4)/$d;
			return array($px,$py);
		}
	
	
	//Static functions
	
	public static $CachedImages = [];
	
	public static function ClearCachedImages(){
		foreach(self::$CachedImages as $c){
			if(!$c->Destroyed)
				$c->Destroy();
		}
	}
	
	public static function GetColorFromInt($color){
		$i = new Image(10, 10);
		$i->DrawRect(0, 0, 10, 10, $color);
		$rcolor = imagecolorsforindex($i->source, imagecolorat($i->source, 5, 5));//$rgb = imagecolorsforindex($image, (imagecolorat($image, $x, $y)));
		$i->Destroy();
		return $rcolor;
	}
	
	public static function GetColorFromRGBA($rgb){
	 /**
     * Converts a Hex String into RGB
     * Based on
     * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
     * @author Claudio Santoro, C.Bavota, E eu caralho aheuaheuhae
     *
     * @param string $hex Input Hex
     * @return array RGB String
     */
        // remove the hex identifier tag
		
		$r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		
		return [$r, $g, $b];
	}
}

//Image::ClearCachedImages();