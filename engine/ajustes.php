<?php
/* #################################################################### \
||                                                                     ||
|| TotixCMS v5 - El uso de este software es privado y único            *#
|| # Copyright (C) 2016 @Author: Francisco Olivera <Totix>             *#
||---------------------------------------------------------------------*#
||---------------------------------------------------------------------*#
|| Script pensado para la gestión de retroservers Habbo.               *#
|| Tanto el script como los autores del mismo no tienen ningún tipo    *#
|| de asociación con Habbo y/o Sulake Oy Corp. Por lo tanto, estos no  *#
|| se hacen responsables del uso que el usuario le dé.                 *#
||                                                                     ||
\ #################################################################### */

class Conexion extends mysqli {
	
	// Servidor
	private $host = 'localhost';
	// Usuario
	private $user = 'root';
	// Contraseña
	private $pass = '';
	// Base de datos
	private $datab = 'kash';
	
	public function __construct() {
		
		parent::__construct($this->host, $this->user, $this->pass, $this->datab);
		
		if($this->connect_errno) {
			die('Error en la conexión: ' . $this->connect_error);
		} else {
		    $this->query("SET NAMES 'utf8';");
		}
		
	}
	
}

class datos {
	public function sitio($a) {
		
		$datoss = array(
		    // URL del sitio web con http://
			'www'    =>    'http://localhost',
			// Nombre de tu sitio web
			'name'   =>    'Habbo',
			// Misión predeterminada
			'mision' =>    'Nuev@ en Habbo!',
			// Portada predeterminada
			'portada'=>    '/app/images/me-bg.png',
			// ¿Desde que rango se muestra en la página staff?
			'minrank'=>    '2',
			// ¿Desde que rango puedes ingresar a la HK?
			'hkmin'  =>    '8',
			// Estos rangos podran ver más cosas en la HK y por lo tanto tendras más responsabilidad
			'hkmax'  =>    '13',
			// Carpeta del panel de administración
			'panel'  =>    '/panel',
			// Pin del panel de administración
			'pinhk'  =>    '2429',
			// Url de facebook
			'fb'     =>    'https://www.facebook.com/OnPixels.US',
			// Url del logo
			'logo'   =>    'http://localhost/app/images/logo.png',
			// Avatar
			'avatar' =>    'http://www.habbo.nl/habbo-imaging/avatarimage?figure=',
			// Placas
			'badges' =>    'http://localhost/swf/c_images/album1584/'
		);
		
		return $datoss[$a];
		
	} 
	public function cliente($a) {
		
		$config = array (
		    // IP de tu hotel
		    'host' 					=> '127.0.0.1',
			// Puerto del hotel
	        'port' 					=> '30000',
			// external_variables
	        'external_variables' 	=> 'http://localhost/swf/gamedata/external_variables.txt?asasddN',
			// Textos del cliente
	        'external_flash_texts' 	=> 'http://localhost/swf/gamedata/external_flash_texts.txt?asdasdgasdaassd',
			// External ov var
			'ext_ov_var'            => 'http://localhost/swf/gamedata/override/external_override_variables.txt',
			// External ov txt
			'ext_ov_txt'            => 'http://localhost/swf/gamedata/override/external_flash_override_texts.txt',
			// Productdata
	        'productdata' 			=> 'http://localhost/swf/gamedata/productdata.txt',
			// Furnidata
	        'furnidata' 			=> 'http://localhost/swf/gamedata/furnidata.xml?12',
			// Figuredata
			'figuredata'            => 'http://localhost/swf/gamedata/figuredata.xml',
			// Figuremap
			'figuremap'             => 'http://localhost/swf/gamedata/figuremap.xml',
            // Release			
	        'flash_client_url' 		=> 'http://localhost/swf/gordon/PRODUCTION-201607262204-86871104/',
			// SWF
	        'habbo_swf' 			=> 'HSlideTotix.swf'
		);
		
		return $config[$a];
	}
}
?>