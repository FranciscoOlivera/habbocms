<?php
#Setting Up
ini_set("display_errors", "1");
ini_set("html_errors", "0");
ini_set("error_log", __DIR__ ."/logs/php_error.log");
ini_set("default_charset ", "utf-8");

set_time_limit(0);
date_default_timezone_set("America/Caracas");

define("TEXTURE_PATH", __DIR__ . "/assets/mixed/");
define("SPRITE_PATH", __DIR__ . "/assets/mixed/");

define("IMG_NOTFOUND_SRC", "assets/sprites/__notfound.png");
define("SHOW_NOTFUND_IMG", false);

define("SHELL_EXTRACT_PATH", __DIR__ . "/extractors/");

define("SWF_EXTRACT_FURNITURE_PATH", "C:/xampp/htdocs/swf/dcr/hof_furni/");
define("SWF_EXTRACT_SPRITES_PATH", "C:/xampp/htdocs/swf/gordon/PRODUCTION-201607262204-86871104/");
define("SWF_EXTRACT_TEXTURES_PATH", "C:/xampp/htdocs/swf/gordon/PRODUCTION-201607262204-86871104/");

define("SWF_EXTRACT_IMAGE_TEXTURE_OUTPUT_PATH", __DIR__ . "/assets/mixed/");
define("SWF_EXTRACT_IMAGE_SPRITE_OUTPUT_PATH", __DIR__ . "/assets/mixed/");

define("SWF_EXTRACT_PALETTE_OUTPUT_PATH", __DIR__ . "/assets/palettes/");
define("SWF_EXTRACT_BINARY_OUTPUT_PATH", __DIR__ . "/assets/binaries/");

define("FILE_OUTPUT_ENAMED_FOLDER", true);

define("LOG_FURNI_NOT_FOUND", "logs/FurnisNotFound.txt");

define("PICTURES_OUTPUT", __DIR__ . "/pictures/");


spl_autoload_register( function($class)
{
    require_once 'library/'.str_replace('\\', '/', $class.'.php');
});
?>