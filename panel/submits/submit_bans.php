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

require_once '../../engine/funciones.php';
$totix->checklogged('no');
$totix->banned();	
$totix->checkrank('sin-acceso');

if(!isset($_SESSION['hk_loged'])) 
{ 
    header("Location: ".www . panel ."");
    exit; 	
} 

if(isset($_POST['ban_submit'])) 
{
	if($_POST['ban_format'] == 'horas')
	{
		$time = $_POST['ban_time'] * 3600;
		$tiempo = $time + time();
	}
	elseif($_POST['ban_format'] == 'dias')
	{
		$time = $_POST['ban_time'] * 86400;
		$tiempo = $time + time();
	}
	elseif($_POST['ban_format'] == 'meses')
	{
		$time = $_POST['ban_time'] * 2592000;
		$tiempo = $time + time();
	}
	elseif($_POST['ban_format'] == 'anios')
	{
		$time = $_POST['ban_time'] * 31104000;
		$tiempo = $time + time();
	}
	
	$sqlchecku = $db->query("SELECT * FROM users WHERE username = '". $_POST['ban_user'] ."' LIMIT 1");
	$user = $sqlchecku->fetch_assoc();
	
	$sqlcheckb = $db->query("SELECT * FROM bans WHERE value = '". $_POST['ban_user'] ."' OR value = '". $user['ip_last'] ."' LIMIT 1");
	
	if(empty($_POST['ban_user']) || empty($_POST['ban_time']) || empty($_POST['ban_format']) || empty($_POST['ban_reason']))
	{
		$_SESSION['ban_error'] = 'No dejes espacios en blanco';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif($sqlchecku->num_rows == 0) 
	{
		$_SESSION['ban_error'] = 'El usuario que intentas banear, no existe';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif($sqlcheckb->num_rows > 0) 
	{
		$_SESSION['ban_error'] = 'Este usuario, ya esta baneado';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif($totix->user('rank') < $user['rank'])
	{
		$_SESSION['ban_error'] = 'No puedes banear a un rango más alto que tú';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif($totix->user('username') == $_POST['ban_user'])
	{
		$_SESSION['ban_error'] = 'No te puedes banear a ti mismo';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif($_POST['ban_user'] == 'Totix')
	{
		$_SESSION['ban_error'] = 'No puedes banear a este usuario, es el desarrollador';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif(is_numeric($_POST['ban_time']))
	{
		if(strrpos($_POST['ban_time'], ".") || strrpos($_POST['ban_time'], ".") !== false)
		{
			$_SESSION['ban_error'] = 'El tiempo no puede llevar puntos';
		    header("Location: ". www . panel ."/bans.php");
		    exit;
		}
		else
		{
		    $db->query("INSERT INTO bans (bantype, value, reason, expire, added_by, added_date) VALUES ('user', '". $totix->filtro($_POST['ban_user']) ."', '". $totix->filtro($_POST['ban_reason']) ."', '". $tiempo ."', '". $totix->user('username') ."', '". time() ."')");
		    $db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Crea', 'Baneo a " . $totix->filtro($_POST['ban_user']) . "', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
		    $_SESSION['ban_resultado'] = 'Usuario baneado correctamente';
		    header("Location: ". www . panel ."/bans.php");
		    exit;
		}
	}
	else
	{
		$_SESSION['ban_error'] = 'El tiempo solo puede llevar numeros';
		header("Location: ". www . panel ."/bans.php");
		exit;
	}
}
elseif(isset($_POST['ban_del']))
{
	$checkn = $db->query("SELECT * FROM bans WHERE id = '". $_POST['ban_del'] ."' LIMIT 1");
	
	if($checkn->num_rows > 0)
	{
		$db->query("DELETE FROM bans WHERE id = '". $_POST['ban_del'] ."' LIMIT 1");
		$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Del', 'Desbaneo a un usuario', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
		$_SESSION['ban_resultado'] = 'Ban borrado correctamente';
		header("Location: ". www . panel ."/bans.php");
	    exit;
	}
	else
	{
		$_SESSION['ban_error'] = 'El baneo que intentas borrar, no existe';
	    header("Location: ". www . panel ."/bans.php");
		exit;
	}
}
elseif(isset($_POST['ban_submit_m']) && is_numeric($_POST['ban_submit_m']))
{
	$checkar = $db->query("SELECT * FROM bans WHERE id = '" . $totix->filtro($_POST['ban_submit_m']) ."' LIMIT 1");
	$banm = $checkar->fetch_assoc();
	
	if(empty($_POST['ban_time_m']))
	{
		$tiempom = $banm['expire'];
	}
	elseif($_POST['ban_format_m'] == 'horas')
	{
		$timem = $_POST['ban_time_m'] * 3600;
		$tiempom = $timem + $banm['expire'];
	}
	elseif($_POST['ban_format_m'] == 'dias')
	{
		$timem = $_POST['ban_time_m'] * 86400;
		$tiempom = $timem + $banm['expire'];
	}
	elseif($_POST['ban_format_m'] == 'meses')
	{
		$timem = $_POST['ban_time_m'] * 2592000;
		$tiempom = $timem + $banm['expire'];
	}
	elseif($_POST['ban_format_m'] == 'anios')
	{
		$timem = $_POST['ban_time_m'] * 31104000;
		$tiempom = $timem + $banm['expire'];
	}
	
	if(empty($_POST['ban_reason_m']))
	{
		$_SESSION['ban_error'] = 'Tienes que poner una razón de baneo';
	    header("Location: ". www . panel ."/bans.php");
		exit;
	}
	elseif($checkar->num_rows < 1)
	{
		$_SESSION['ban_error'] = 'El baneo que intentas editar, no existe';
	    header("Location: ". www . panel ."/bans.php");
		exit;
	}
	else
	{   
        $db->query("UPDATE bans SET reason = '".$totix->filtro($_POST['ban_reason_m'])."', expire = '".$tiempom."' WHERE id = '".$_POST['ban_submit_m']."' LIMIT 1");
        $db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Mod', 'Modifico el baneo de un usuario', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
		$_SESSION['ban_resultado'] = 'Ban borrado correctamente';
		header("Location: ". www . panel ."/bans.php");       
        exit;		
	}
}
else
{
	header("Location: ". www . panel ."/bans.php");
}
?>