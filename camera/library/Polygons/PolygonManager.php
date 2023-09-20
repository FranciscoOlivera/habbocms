<?php
namespace Polygons;

use Images\Image;
use Images\Extractor\ImageExtractor;
use Log\LogManager as Log;
class PolygonManager {
	
	public $ploygons;
	public $image;
	public $cachedPolygons;
	public function __construct($image){
		$this->image = $image;
		$this->cachedPolygons = [];
		$this->polygons = [];
	}
	
	public function SetPolygon($array, $color, $texCols, $masks, $bottomAligned){
		$p = new PolygonItem($array, $color, $texCols, $masks, $bottomAligned);
		$this->polygons[] = $p;
		return $p;
	}
	
	public function DrawPolygons(){
		foreach($this->polygons as $polykey => $p){
			//Array of Points
			$i = [];
			$lp = null;
			$complete = false;
			foreach($p->Coords as $k => $c){
				//$c => A point
							
				$i[] = $c->x;
				$i[] = $c->y;
			}
			
			//$img = image
			
			$this->image->DrawPolygon($i, $p->Color);
			Log::LogDrawingImage($this->image);
			/*ob_start();
			imagepng($this->image->source);
			$c = ob_get_contents();
			file_put_contents("makingStep/Making Planes step - $polykey.png", $c);
			ob_end_clean();*/
		}
	}
	
	
	public function DrawTextures(){
		foreach($this->polygons as $polykey => $poly){
			foreach($poly->textures as $texkey => $tex){
				foreach($tex->assetNames as $assetname){
					if($assetname == "")
						continue;
					
					$found = true;
					$image = ImageExtractor::GetTexture($assetname, $found);
					if(!$found && !SHOW_NOTFUND_IMG)
						continue;
					
					$img = new Image();
					$img->SetImageFromContentString($image, $assetname);
					$w = $img->width;
					$h = $img->height;
					//$img->FlushTransparency();
					$points = $poly->CoordsToArray();
				
					$color = Image::GetColorFromInt($poly->Color);
					$img->FlushTransparency();
					$img->SetTransparency(248, 248, 248);
					
					
					//Modeling Image Asset
					
					
					
					/*if($poly->GetMedH() != $poly->GetMedW())
						$img->Resize($img->width * 2, $img->height);*/
					
					##Take Care with iamge repeating in polygon (Background repeatitive and perspective)
					$maxW = max(
						$points[0], 
						$points[2], 
						$points[4], 
						$points[6]
					);
					
					$maxH =  max(
						$points[1],
						$points[3],
						$points[5],
						$points[7]
					);
					
					$minW = min(
						$points[0], 
						$points[2], 
						$points[4], 
						$points[6]
					);
					
					$minH = min(
						$points[1],
						$points[3],
						$points[5],
						$points[7]
					);
					
					$medW = $maxW - $minW;
					$medH = $maxH - $minH;
					
					$isRectangle = $medW != $medH;
					$isRectangleLayed = $isRectangle || $medW > $medH;
					
					$newTex;
					
					/*$newTex	= new Image(
										//Width
										$poly->PolygonHeight() == 0 || $poly->PolygonWidth() * 2 == $poly->PolygonHeight() ? $medW  : $medW / 2,
										//Height
										$medH);*/
					
					
					/*$testimg = new Image($poly->GetMedW(), $poly->GetMedH());
					Log::LogDrawingImage($testimg);
					$testimg->Destroy();*/
					Log::LogDrawingStepText("$assetname : Poly Size: " . $poly->GetMedW() . " x " . $poly->GetMedH());
					
					if($poly->GetMedW() > $poly->GetMedH()){
						if($poly->GetMedW() / 2 == $poly->GetMedH())
							$newTex = new Image($poly->GetMedW() / 2, $poly->GetMedH());
						else
							$newTex = new Image($poly->GetMedW(), $poly->GetMedH());
						Log::LogDrawingStepText("|W > H");
					}
					elseif($poly->GetMedW() == $poly->GetMedH()){
						$newTex = new Image($poly->GetMedW(), $poly->GetMedH());
						Log::LogDrawingStepText("|W  = H");
					}
					else{
						$newTex = new Image($poly->GetMedW(), $poly->GetMedH() / 2);
						Log::LogDrawingStepText("|W < H");
					}
						
					$newTex->SetTransparency(0,0,0);
					
					
					//$newTex	= new Image((max($medW, $img->width) / 2) * 2,  min($medW, $medH)); //Little Floor Square Sides
					
					/*$newTex	= new Image(
									//Width
									$medW / (floor(max($medW, $medH) / min($medW, $medH)) > 0 
										? 
									floor(max($medW, $medH) / min($medW, $medH)) 
										: 
									1),
									//Height
									(floor($medH / $medW) > 0 
										? 
									floor($medH / $medW) 
										: 
									1) >= 0 ? $medH  : $medH); //Little Floor Square Sides*/
									
					//$newTex->Resize($newTex->width - 2, $newTex->height - 1);
					/*for($y = 0; $y < $newTex->width + $img->width; $y += $img->width)
						for($x = 0; $x < $newTex->height + $img->height; $x += $img->height){
							$newTex->PasteImage($img, $x, $y);
						}*/
						
						//Box top = Box.Y
						//Box bottom = Box.Y + Box.Height
						$addedY = 0;
						for($y = 0; $y < $newTex->height && !$poly->bottomAligned; $y += $img->height)
						{
							if($y + $img->height >= $newTex->height)
							{
								$newTex->Crop(0, 0, $newTex->width, $y + $img->height);
							}
						}
						
						//$newTex->Crop(0, 0, $newTex->width, $newTex->height);
						
						$newTex->SetTransparency(255,255,255);
						$newTex->FlushTransparency();
						$newTex->SetTile($img);
						$newTex->DrawRect(0, 0, $newTex->width, $newTex->height, -5);
						$img->Destroy();
						
						
						if(isset($poly->masks))
							foreach($poly->masks as $mask){
								
								$asset = ImageExtractor::GetTexture($mask->name);
								$maskimg = new Image();
								
								$maskimg->SetImageFromContentString($asset);
								//$newTex->AddMask($maskimg, $mask->location->x, $mask->location->y);
								$newTex->PasteImage($maskimg, $mask->location->x, $mask->location->y);
								$newTex->SetTransparency(0,0,0);
								//Log::LogDrawingImage($maskimg);	
								$maskimg->Destroy();
							}
						
					
					Log::LogDrawingImage($newTex);
					
					$newTex->createPerspective(
						$points[4], $points[5],
						$points[6] , $points[7],
						$points[0], $points[1],
						$points[2], $points[3], 
						$poly->bottomAligned
					);
					
					Log::LogDrawingImage($newTex);
					//$newTex->DrawRect($points[4], $points[5], 10, 10, 0);
					//$newTex->DrawRect($points[6] - 1, $points[7] - 1, 10, 10, 0);
					//$newTex->DrawRect($points[0] - 4, $points[1] - 4, 10, 10, 0);
					//$newTex->DrawRect($points[2], $points[3], 10, 10, 0);
					
					//$imgtocache = new Image($newTex->width, $newTex->height);
					//$imgtocache->PasteImage($newTex, 0, 0);
					//$imgtocache->Src = $assetname;
					
					
					##Ready, Now recolor and its ready to go
					$newTex->Recolor($color["red"], $color["blue"], $color["green"]);
					
					if(!isset($poly->masks)){
						$this->image->SetTile($newTex);
						$this->image->DrawPolygon($points, -5);
					}else{
						
						$masks = [];
						foreach($poly->masks as $mask){
							$found = true;
							$maskasset = ImageExtractor::GetTexture($mask->name, $found);
							$img = new Image();
							$img->SetImageFromContentString($maskasset);
							if(!$found)
								continue;
							
							$masks[] = (object)(["image" => $img, "loc" => $mask->location]);
							
							
						}
						$this->image->PasteImageWithMasks($newTex, 0, 0, $masks);
						
					}
					//$this->image->DrawRect(0, 0, $newTex->width, $newTex->height,-5);
						$newTex->Destroy();
					
					
					//$newTex->Destroy();
					
					Log::LogDrawingImage($this->image);
					Log::LogDrawingStepText("<br><br>");
					
					//return;
				}
			}	
		}
	}
	
	
	/*
	NOT WORKING AS I WISHED :C
	public function GetMatchPolygon($poly, $imagename){
		foreach($this->cachedPolygons as $cache){
			if($cache["image"]->Src == $imagename){
				$p = $cache["p"];
				if(
					$poly->GetMedW() == $p->GetMedW() &&
					$poly->GetMedH() == $p->GetMedH()
				){
					$img = $cache["image"];
					
					$newimg = new Image($img->width, $img->height);
					$newimg->SetTile($img);
					$newimg->DrawRect(0, 0, $img->width, $img->height, 10);
					$newimg->FlipH();
					return $newimg;
					
				}
			}
		}
		
		return null;
	}
	
	public function CachePolygon($polygon, $image){
		$this->cachedPolygons[] = [
			"p" => $polygon,
			"image" =>$image
		];
	}*/
	
	
	
	//My Heroes
	
	
	
	
	
	
}
