<?php
namespace Images;
class ImagePasteManager {
	public $images;
	
	public $image;
	public function __construct($image){
		$this->image = $image;
		$this->images = [];
	}
	
	public function Add($image, $x, $y){
		$c = new ImagePasteItem($image, $x, $y);
		$this->images[] = $c;
		return $c;
	}
	
	public function DrawImages(){
		foreach($this->images as $img){
			$this->image->PasteImage($img->image, $img->x, $img->y);
		}
	}
}