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

session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("America/Chihuahua");
require_once 'ajustes.php';
$db = new Conexion();
$datos = new datos();

define('www', $datos->sitio('www'));
define('name', $datos->sitio('name'));
define('mision', $datos->sitio('mision'));
define('avatar', $datos->sitio('avatar'));
define('logo', $datos->sitio('logo'));
define('fb', $datos->sitio('fb'));
define('badges', $datos->sitio('badges'));
define('portada', $datos->sitio('portada'));
define('minrank', $datos->sitio('minrank'));
define('hkmin', $datos->sitio('hkmin'));
define('hkmax', $datos->sitio('hkmax'));
define('panel', $datos->sitio('panel'));
define('pinhk', $datos->sitio('pinhk'));

class totixcms {
	
	public function copyright() {
		// Hash copyright
		$hash = "VG90aXhDTVM=";

		return $hash;
	}

	public function hasht($password) {

		$password = md5($password);

		return $password;
	}
	
	public function fecha($a) {
		$H = date('H');
        $i = date('i');
        $s = date('s');
        $m = date('m');
        $d = date('d');
        $Y = date('Y');
        $j = date('j');
        $n = date('n');
        $today = $d;
        $month = $m;
        $year = $Y;
        $getmoney_date = date('d/m/Y',mktime($m,$d,$Y));
        $birthday_date = date('d/m', mktime($m,$d));
        $date_normal = date('d/m/Y',mktime($m,$d,$Y));
        $date_full = date('d/m/Y - H:i:s',mktime($H,$i,$s,$m,$d,$Y));
		
		$fecha = array('normal' => $date_normal, 'completa' => $date_full);
		
		return $fecha[$a];
	}
	
	public function fecha_dat($a) {
		$day = date("d", $a);
		$dname = date("m", $a);
		$year = date("Y", $a);
		$ampm = date("a", $a);
		$hour = date("g", $a);
		$minuts = date("i", $a);
		
		switch($dname)
		{
			case 1: $dname = "enero"; break;
			case 2: $dname = "febrero"; break;
			case 3: $dname = "marzo"; break;
			case 4: $dname = "abril"; break;
			case 5: $dname = "mayo"; break;
			case 6: $dname = "jun"; break;
			case 7: $dname = "julio"; break;
			case 8: $dname = "agosto"; break;
			case 9: $dname = "septiembre"; break;
			case 10: $dname = "octubre"; break;
			case 11: $dname = "noviembre"; break;
			case 12: $dname = "diciembre"; break;
		}
		return $day." de ".$dname." del ".$year." a la(s) ".$hour.":".$minuts." ".$ampm;
	}
	
	public function getlast($a){
		$day = date("d", $a);
		$dname = date("m", $a);
		$year = date("Y", $a);
		$ampm = date("a", $a);
		$hour = date("g", $a);
		$minuts = date("i", $a);
		
		$datenow = time();
		$difference = $datenow - $a;
		
		switch($dname)
		{
			case 1: $dname = "enero"; break;
			case 2: $dname = "febrero"; break;
			case 3: $dname = "marzo"; break;
			case 4: $dname = "abril"; break;
			case 5: $dname = "mayo"; break;
			case 6: $dname = "jun"; break;
			case 7: $dname = "julio"; break;
			case 8: $dname = "agosto"; break;
			case 9: $dname = "septiembre"; break;
			case 10: $dname = "octubre"; break;
			case 11: $dname = "noviembre"; break;
			case 12: $dname = "diciembre"; break;
		}
		
		$minutos = date('i', $difference);
		
		if($difference <= 59)
		{
			return 'Hace ' . $difference . ' segundo(s)';
		}
		elseif($difference <= '3599' && $difference >= '60')
		{ 
			if($minutos[0] == 0) { 
			    $minutos = $minutos[1]; 
			}
			if($minutos == 1) { 
			    $minutos_str = 'minuto'; 
			}
			else { 
			    $minutos_str = 'minutos'; 
			}
			return 'Hace '.$minutos.' '.$minutos_str;
	    }
		elseif($difference >= '3600' && $difference <= '86399') 
		{
			return 'Hoy a la(s) '.$hour.':'.$minuts. ' '.$ampm;
		}
		elseif($difference >= '86400' && $difference <= '172799')
		{
			return 'Ayer a la(s) '.$hour.':'.$minuts. ' '.$ampm;
		}
		else
		{
			return $day." de ".$dname." del ".$year." a la(s) ".$hour.":".$minuts." ".$ampm;
		}
	}
	
	public function voucher() {
		
		$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $numerodeletras = 10;
        $voucher_rand = "";
        for($i=0;$i<$numerodeletras;$i++)
        {
            $voucher_rand .= substr($caracteres,rand(0,strlen($caracteres)),1);
        }
		
		return $voucher_rand;
	}
	
	public function ip() {
	    if($_SERVER) {
		    if($_SERVER["HTTP_X_FORWARDED_FOR"]) {
		    $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		    } elseif ($_SERVER["HTTP_CLIENT_IP"]) {
		    $realip = $_SERVER["HTTP_CLIENT_IP"];
		    } else {
		    $realip = $_SERVER["REMOTE_ADDR"];
		    }
	    } else {
	    			if(getenv("HTTP_X_FORWARDED_FOR")) {
					$realip = getenv("HTTP_X_FORWARDED_FOR");
				    } elseif(getenv("HTTP_CLIENT_IP")) {
					$realip = getenv("HTTP_CLIENT_IP");
				    } else {
					$realip = getenv("REMOTE_ADDR");
				    }
			    }
	return $realip;
    }
	
	public function filtro($str) {
		global $db;
		$str = $db->real_escape_string(htmlspecialchars(trim($str)));
		$texto = $str;
		$texto = str_replace("INSERT","IN-SER-T",$texto);
		$texto = str_replace("DELETE","DE-LE-TE",$texto);
		$texto = str_replace("TRUNCATE","TRUN-CA-TE",$texto);
		$texto = str_replace("SELECT","SE-LEC-T",$texto);
		$texto = str_replace("ALTER","AL-TER",$texto);
		$texto = str_replace("UPDATE","UP-DA-TE",$texto);
		$texto = str_replace("inert","IN-SER-T",$texto);
		$texto = str_replace("delete","DE-LE-TE",$texto);
		$texto = str_replace("truncate","TRUN-CA-TE",$texto);
		$texto = str_replace("select","SE-LEC-T",$texto);
		$texto = str_replace("alter","AL-TER",$texto);
		$texto = str_replace("update","UP-DA-TE",$texto);
		$texto = str_replace("script","S-C-R-I-P-T",$texto);
		$texto = str_replace("Script","S-C-R-I-P-T",$texto);
		$texto = str_replace("SCRIPT","S-C-R-I-P-T",$texto);
		$texto = str_replace('"','&#34;',$texto);
		$texto = str_replace("'","&#39;",$texto);
		$texto = str_replace("<","&#60;",$texto);
		$texto = str_replace(">","&#62;",$texto);
		$texto = str_replace("(","&lpar;",$texto);
		$str = str_replace(")","&rpar;",$texto);
		return $str;
	}
	
	public function bbcode($bbcode) {
		global $datos;
		$text = $this->filtro($bbcode);
		$txt = $text;
		
		$txt = str_replace("*sonrisa*", '<img src="/app/images/emojis/Emoji%20Smiley-01.png" width="30" height="30" />', $txt);
		$txt = str_replace("*feliz*", '<img src="/app/images/emojis/Emoji%20Smiley-04.png" width="30" height="30" />', $txt);
		$txt = str_replace("*enamorado*", '<img src="/app/images/emojis/Emoji%20Smiley-07.png" width="30" height="30" />', $txt);
		$txt = str_replace("*besar*", '<img src="/app/images/emojis/Emoji%20Smiley-08.png" width="30" height="30" />', $txt);
		$txt = str_replace("*loco*", '<img src="/app/images/emojis/Emoji%20Smiley-12.png" width="30" height="30" />', $txt);
		$txt = str_replace("*triste*", '<img src="/app/images/emojis/Emoji%20Smiley-17.png" width="30" height="30" />', $txt);
		$txt = str_replace("*tranqui*", '<img src="/app/images/emojis/Emoji%20Smiley-18.png" width="30" height="30" />', $txt);
		$txt = str_replace("*ayno*", '<img src="/app/images/emojis/Emoji%20Smiley-19.png" width="30" height="30" />', $txt);
		$txt = str_replace("*lol*", '<img src="/app/images/emojis/Emoji%20Smiley-23.png" width="30" height="30" />', $txt);
		$txt = str_replace("*llora*", '<img src="/app/images/emojis/Emoji%20Smiley-24.png" width="30" height="30" />', $txt);
		$txt = str_replace("*preocupado*", '<img src="/app/images/emojis/Emoji%20Smiley-27.png" width="30" height="30" />', $txt);
		$txt = str_replace("*wow*", '<img src="/app/images/emojis/Emoji%20Smiley-33.png" width="30" height="30" />', $txt);
		$txt = str_replace("*enojado*", '<img src="/app/images/emojis/Emoji%20Smiley-35.png" width="30" height="30" />', $txt);
		$txt = str_replace("*thuglife*", '<img src="/app/images/emojis/Emoji%20Smiley-41.png" width="30" height="30" />', $txt);
		$txt = str_replace("*zzz*", '<img src="/app/images/emojis/Emoji%20Smiley-42.png" width="30" height="30" />', $txt);
		$txt = str_replace("*muerto*", '<img src="/app/images/emojis/Emoji%20Smiley-44.png" width="30" height="30" />', $txt);
		$txt = str_replace("*dfeliz*", '<img src="/app/images/emojis/Emoji%20Smiley-48.png" width="30" height="30" />', $txt);
		$txt = str_replace("*denojado*", '<img src="/app/images/emojis/Emoji%20Smiley-49.png" width="30" height="30" />', $txt);
		$txt = str_replace("*pockerface*", '<img src="/app/images/emojis/Emoji%20Smiley-52.png" width="30" height="30" />', $txt);
		$txt = str_replace("*angel*", '<img src="/app/images/emojis/Emoji%20Smiley-56.png" width="30" height="30" />', $txt);
		$txt = str_replace("*sexy*", '<img src="/app/images/emojis/Emoji%20Smiley-57.png" width="30" height="30" />', $txt);
		$txt = str_replace("*gotas*", '<img src="/app/images/emojis/Emoji%20Smiley-97.png" width="30" height="30" />', $txt);
		$txt = str_replace("*fuego*", '<img src="/app/images/emojis/Emoji%20Smiley-91.png" width="30" height="30" />', $txt);
		$txt = str_replace("*estrellas*", '<img src="/app/images/emojis/Emoji%20Smiley-92.png" width="30" height="30" />', $txt);
		$txt = str_replace("*corazon*", '<img src="/app/images/emojis/Emoji%20Smiley-173.png" width="30" height="30" />', $txt);
		$txt = preg_replace("/((youtubevideo-)[^\s]+)/", '<iframe width="720" height="315" src="https://www.youtube.com/embed/'. substr($txt, -11) .'" frameborder="0" allowfullscreen></iframe>', $txt);
		$a = array( 
			"/\[i\](.*?)\[\/i\]/is", 
			"/\[b\](.*?)\[\/b\]/is", 
			"/\[u\](.*?)\[\/u\]/is", 
			"/\[img\](.*?)\[\/img\]/is", 
			"/\[url=(.*?)\](.*?)\[\/url\]/is",
			"/\[br\]/is"
		); 
		$b = array( 
			"<i>$1</i>", 
			"<b>$1</b>", 
			"<u>$1</u>", 
			"<center><img src=\"$1\" class=\"img-actividad\" /></center>", 
			"<a href=\"$1\" target=\"_blank\">$2</a>" ,
			"<br />"
		); 
		$txt = preg_replace($a, $b, $txt); 
			$txt = nl2br($txt); 
	
		return $txt;
	}
	
	public function onlines() {
		
		global $db;
		$sql_onlines = $db->query("SELECT * FROM users WHERE online = '1'");
		$ons = $sql_onlines->num_rows;
		
		$onlines = '<img src="'.www.'/app/images/online.gif" /> Hay <b>'.$ons.'</b> usuarios en línea';
		
		return $onlines;
	}
	
	public function adduser() {
		
		global $db;
		if(isset($_POST['reg_usuario']) && isset($_POST['reg_mail']) && isset($_POST['reg_contrasena']) && isset($_POST['reg_rcontrasena']))
        {   
	
	        $Getnombre = $db->query("SELECT * FROM users WHERE username = '". $_POST['reg_usuario'] ."'");
	        $Getmail = $db->query("SELECT * FROM users WHERE mail = '". $_POST['reg_mail'] ."'");
    
	        if(isset($_POST['g-recaptcha-response'])){
                  $captcha = $_POST['g-recaptcha-response'];
            }
			
			$look = substr($_POST['habbo-avatar'], 0, -9);
			$gender = substr($_POST['habbo-avatar'], -1);
			$filter = preg_replace("/[^a-z\d\-=\?!@:\.]/i", "", $_POST['reg_usuario']);
    
	        if(empty($_POST['reg_usuario']) || empty($_POST['reg_mail']) || empty($_POST['reg_contrasena']) || empty($_POST['reg_rcontrasena']))
	        {
	        	$_SESSION['reg_error'] = 'No dejes los campos vacios';
				return false;
	        }
			elseif($_POST['reg_usuario'] !== $filter)
			{
				$_SESSION['reg_error'] = 'Inserta un nombre con caracteres válidos';
				return false;
			}
	        elseif($Getnombre->num_rows > 0)
	        {
	        	$_SESSION['reg_error'] = 'El nombre de usuario ya esta en uso, pon otro';
				return false;
	        }
	        elseif($Getmail->num_rows > 0)
	        {
	        	$_SESSION['reg_error'] = 'El email ya esta en uso, pon otro';
				return false;
	        }
	        elseif($_POST['reg_contrasena'] !== $_POST['reg_rcontrasena'])
	        {
	        	$_SESSION['reg_error'] = 'Las contraseñas no coinciden';
				return false;
	        }
            elseif(strlen($_POST['reg_usuario']) > 12 || strlen($_POST['reg_usuario']) < 3) 
	        {
                $_SESSION['reg_error'] = 'El nombre de usuario debe de tener entre 3 y 12 caracteres';
				return false;
	        } 
	        elseif(strrpos($_POST['reg_usuario'], "MOD-") !== false) 
	        {
	            $_SESSION['reg_error'] = 'No puedes registrarte con el prefijo <i>MOD-</i>';
				return false;
            } 
	        elseif(strrpos($_POST['reg_usuario'], " ") || strrpos($_POST['reg_usuario'], " ") !== false) 
	        {
	            $_SESSION['reg_error'] = 'Tu nombre no puede contener espacios';
				return false;
	        } 
	        elseif(strrpos($_POST['reg_usuario'], ".") || strrpos($_POST['reg_usuario'], ".") !== false) 
	        {
	            $_SESSION['reg_error'] = 'Tu nombre no puede contener puntos';
				return false;
	        } 
	        elseif (!$captcha) 
	        {
                $_SESSION['reg_error'] = 'Chequea el captcha de manera correcta';
				return false;
            }
	        else
	        {
	        	$db->query("INSERT INTO users (username, password, mail, look, gender, motto, ip_reg, portada, date_created) VALUES ('". $this->filtro($_POST['reg_usuario']) ."', '".$this->hasht($_POST['reg_contrasena'])."', '". $this->filtro($_POST['reg_mail']) ."', '". $look ."', '". $gender ."', '". mision ."', '". $this->ip() ."', '". portada ."', '" . time() ."')");
	        	$_SESSION['username'] = $_POST['reg_usuario'];
	        	$_SESSION['password'] = $_POST['reg_contrasena'];
				return true;
	        }
        }
	}
	
	public function checkinfo() {
		
		global $db;
		$sql_user = $db->query("SELECT * FROM users WHERE username = '". $this->filtro($_POST['username']) ."' AND password = '". $this->hasht($_POST['password']) ."' LIMIT 1");
		
		if(isset($_POST['username']) && isset($_POST['password']))
		{
		    if(empty($_POST['username']) || empty($_POST['password']))
		    {
		    	$loginerror = 'Por favor rellena todos los campos';
		    	$_SESSION['login_error'] = $loginerror;
		    	return false;
		    }
		    elseif($sql_user->num_rows < 1)
		    {
		    	$loginerror = 'Los datos son incorrectos o el nombre de usuario no existe';
		    	$_SESSION['login_error'] = $loginerror;
		    	return false;
		    }
		    elseif($sql_user->num_rows > 0)
		    {
		    	$_SESSION['username'] = $_POST['username'];
		    	$_SESSION['password'] = $_POST['password'];
		    	return true;
		    }
		}
	}
	
	public function checklogged($a) {
		if($a == 'yes')
		{
		    if(isset($_SESSION['username']) && isset($_SESSION['password']))
			{
				header("Location: /me");
				exit;
			}
		}
		elseif($a == 'no')
		{
			if(empty($_SESSION['username']) && empty($_SESSION['password']))
			{
				header("Location: /");
				exit;
			}
		}
	}

	public function user($a) {
		global $db;
		$user = $db->query("SELECT * FROM users WHERE username = '". $_SESSION['username'] ."' AND password = '". $this->hasht($_SESSION['password']) ."' LIMIT 1");
		if($user->num_rows > 0)
		{
			$usr = $user->fetch_array();
			return $usr[$a];
		}
		else
		{
			switch($a) 
			{
				case 'id':
				return 0;
				break;
				case 'username':
				return 'Invitado';
			    break;
				case 'motto':
				return 'Tengo que registrarme!';
				break;
				case 'look':
				return 'sh-290-1408.ch-215-1301.lg…70-1223.hd-180-1.hr-100-40';
				break;
			}
		}
	}
	
	public function checkrank($a) {
		
		if($a == 'sin-acceso' && $this->user('rank') < hkmin) 
		{
			header("Location: /");
			exit;
		}
		elseif($a == 'maxrank' && $this->user('rank') < hkmax)
		{
			header("Location: ".www.panel."");
			exit;
		}
	}
	
	public function contar($cosa, $nombre) {
		
		global $db;
		switch($cosa)
		{
			case 'amigos':
			$contador = $db->query("SELECT * FROM messenger_friendships WHERE user_one_id = '" . $nombre . "' OR user_two_id = '" . $nombre . "'");
			$result = $contador->num_rows;
			
			return $result;
			break;
			case 'fotos':
			$contador = $db->query("SELECT * FROM server_pictures WHERE user_id = '". $nombre ."'");
			$result = $contador->num_rows;
			
			return $result;
			break;
			case 'salas':
			$contador = $db->query("SELECT * FROM rooms WHERE owner = '". $nombre ."'");
			$result = $contador->num_rows;
			
			return $result;
			break;
		}
		
	}
	
	public function verificado($rango) {
		
		if($rango > minrank)
		{
			return ' <i class="icono azul glyphicon glyphicon-ok" title="Verificado"></i>';
		}
	}
	
	public function banned() {
		
		global $db;
		$checkban = $db->query("SELECT * FROM bans WHERE value = '". $this->user('username') ."' OR value = '". $this->ip() ."' LIMIT 1");
		
		if($checkban->num_rows > 0)
		{
			header("Location: /banned");
			exit;
		}
	}
	
	public function hk_login() {
		
		global $db;
		if(isset($_POST['hk_submit']))
		{
			if(empty($_POST['hk_username']) || empty($_POST['hk_password']) || empty($_POST['hk_pin']))
			{
				$_SESSION['hk_error'] = 'No dejes espacios en blanco';
				return false;
			}
			elseif($_POST['hk_username'] != $_SESSION['username'])
			{
				$_SESSION['hk_error'] = 'El nombre de usuario que intentas poner, no pertenece a tu cuenta activa actualmente';
				return false;
			}
			elseif($_POST['hk_password'] != $_SESSION['password'])
			{
				$_SESSION['hk_error'] = 'La contraseña no es la correcta';
				return false;
			}
			elseif($_POST['hk_pin'] != pinhk) 
			{
				$_SESSION['hk_error'] = 'El pin de seguridad no es el correcto';
				return false;
			}
			elseif($this->user('rank') < hkmin)
			{
				$_SESSION['hk_error'] = 'No tienes el rango suficiente para entrar al panel de administración';
				return false;
			}
			else
			{
				$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Logeo', '". $this->user('username') ." ingreso al panel', '". $this->user('rank') ."', '". $this->user('id') ."', '". time() ."')");
                $_SESSION['hk_loged'] = 'loged';
				return true;
			}
		}
	}
}

$totix = new totixcms();

?>