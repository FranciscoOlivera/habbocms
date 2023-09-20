<?php

namespace Sprites;

use Images\Extractor\ImageExtractor;

class SpriteItem {
	public $x;
	public $y;
	public $z;
	public $alpha;
	public $color;
	public $assetname;
	public $blendMode;
	public $flipH;
	
	public function __construct($sprite){
		$this->x = $sprite->x;
		$this->y = $sprite->y;
		$this->z = $sprite->z;
		$this->assetname = $sprite->name;
		$this->color = isset($sprite->color) ? $sprite->color : -1;
		$this->alpha = isset($sprite->alpha) ? $sprite->alpha : -1;
		$this->blendMode = isset($sprite->blendMode) ? $sprite->blendMode : null;
		$this->flipH = isset($sprite->flipH) ? $sprite->flipH : false;
	}
	
	public function GetAssetImage(&$found){
		$g = ImageExtractor::GetSprite($this->assetname);
		if(ImageExtractor::$NotFoundImg->content == $g)
			$found = false;
		else
			$found = true;
		return $g;
	}
}