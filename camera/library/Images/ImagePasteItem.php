<?php

namespace Images;
class ImagePasteItem {
	public $x;
	public $y;
	public $image;
	
	public function __construct($image, $x, $y){
		$this->image = $image;
		$this->x = $x;
		$this->y = $y;
	}
}