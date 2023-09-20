<?php

namespace Polygons;

class PolygonItem {
	public $Coords;
	public $Color;
	public $image;
	
	public $textures;
	public $masks;
	
	public $imagebg;
	public $bottomAligned; 
	public function __construct($array, $color, $textures, $masks, $bottomAligned){
		$this->Coords = $array;
		$this->Color = $color;
		$this->masks = $masks;
		$this->textures = $textures;
		$this->bottomAligned = $bottomAligned;
	}
	
	public function SetImage($image){
		$this->image = $image;
	}
	
	public function GetBiggestX(){
		$x = null;
		foreach($this->Coords as $c){
			if($x === null || $x < $c->x)
				$x = $c->x;
		}
		
		return $x;
	}
	
	public function GetBiggestY(){
		$y = null;
		foreach($this->Coords as $c){
			if($y === null || $y < $c->y)
				$y = $c->x;
		}
		
		return $y;
	}
	
	public function GetSmallestX(){
		$x = null;
		foreach($this->Coords as $c){
			if($x == null || $x > $c->x)
				$x = $c->x;
		}
		
		return $x;
	}
		
	public function GetSmallestY(){
		$y = null;
		foreach($this->Coords as $c){
			if($y == null || $y > $c->y)
				$y = $c->y;
		}
		
		return $y;
	}
	
	public function CoordsToArray(){
		$i = [];
		foreach($this->Coords as $k => $c){
			//$c => A point
						
			$i[] = $c->x;
			$i[] = $c->y;
		}
		
		return $i;
	}
	
	public function PolygonWidth(){
		return ($this->GetBiggestX() - $this->GetSmallestX()) / 2;
	}
	
	public function PolygonHeight(){
		return $this->GetBiggestY() - $this->GetSmallestY();
	}
	
	public function GetMaxW(){
		return max(
			$this->CoordsToArray()[0], 
			$this->CoordsToArray()[2], 
			$this->CoordsToArray()[4], 
			$this->CoordsToArray()[6]
		);
	}
	
	public function GetMaxH(){
		return max(
			$this->CoordsToArray()[1],
			$this->CoordsToArray()[3],
			$this->CoordsToArray()[5],
			$this->CoordsToArray()[7]
		);
	}
	
	public function GetMinW(){
		return min(
			$this->CoordsToArray()[0], 
			$this->CoordsToArray()[2], 
			$this->CoordsToArray()[4], 
			$this->CoordsToArray()[6]
		);
	}
	
	public function GetMinH(){
		return min(
			$this->CoordsToArray()[1],
			$this->CoordsToArray()[3],
			$this->CoordsToArray()[5],
			$this->CoordsToArray()[7]
		);
	}
	
	public function GetMedW(){
		return $this->GetMaxW() - $this->GetMinW();
	}
	
	public function GetMedH(){
		return $this->GetMaxH() - $this->GetMinH();
	}
	
}