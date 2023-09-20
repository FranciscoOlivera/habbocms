<?php

namespace Sprites;

use Images\Image;
use Images\Extractor\ImageExtractor;
use Log\LogManager as Log;
class SpriteManager {
	
	public $sprites;
	public $image;
	
	public function __construct($image){
		$this->sprites = [];
		$this->image = $image;
	}
	
	public function SetSprite($data){
		$spr = new SpriteItem($data);
		$this->sprites[] = $spr;
		return $spr;
	}
	
	
	public function DrawSprites(){
		foreach($this->sprites as $sprkey => $spr){
			if($spr->assetname == "")
				continue;
			
			$img = new Image();
			$found = true;
			$imgcontent = $spr->GetAssetImage($found);
			$img->SetImageFromContentString($imgcontent);
			
			if(!$found && !SHOW_NOTFUND_IMG)
				continue;
			
			if($spr->color > 0){
				$color = Image::GetColorFromInt($spr->color);
				$img->Recolor($color["red"], $color["blue"], $color["green"]);
			}
			
			if($spr->flipH){
				$img->FlipH();
			}
			
			if($spr->alpha > -1){
				$img->Opacity(-$spr->alpha / 2);
			}
			
			if($spr->blendMode){
				switch($spr->blendMode){
					case "add":
						$this->image->BlendAdd($img, $spr->x, $spr->y);
					break;
					
				}
			}
			else
			$this->image->PasteImage($img, $spr->x, $spr->y);

			Log::LogDrawingImage($this->image);
		}
	}
	
}