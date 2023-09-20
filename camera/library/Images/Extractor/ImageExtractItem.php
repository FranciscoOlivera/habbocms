<?php

namespace Images\Extractor;

class ImageExtractItem { 
	public $name;
	public $content;
	public $type;
	public function __construct($name, $content, $type){
		$this->name = $name;
		$this->content = $content;
		$this->type = $type;
	}
}