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

if(isset($_POST['ch_motto_submit'])) {
	
	if(!empty($_POST['ch_motto'])) {
		$db->query("UPDATE users SET motto = '". $totix->filtro($_POST['ch_motto']) ."' WHERE id = '". $totix->user('id') ."' LIMIT 1");
		$_SESSION['resultado_bueno'] = 'Cambiaste la misión correctamente';
		header("Location: ".www."/settings/personales");
		exit;
	} else {
		$_SESSION['resultado'] = 'No dejes el espacio de "misión" vacio';
		header("Location: ".www."/settings/personales");
		exit;
	}
	
} elseif(isset($_POST['ch_fb_submit'])) {
	
	if(strpos($_POST['ch_fb'], "facebook.com") !== false  || strpos($_POST['ch_fb'], "fb.com") !== false || empty($_POST['ch_fb'])) {
		$db->query("UPDATE users SET fb = '". $totix->filtro($_POST['ch_fb']) ."' WHERE id = '". $totix->user('id') ."' LIMIT 1");
		$_SESSION['resultado_bueno'] = 'Actualizaste tu facebook correctamente';
		header("Location: ".www."/settings/personales");
		exit;
	} else {
		$_SESSION['resultado'] = 'Tu link no pertenece a http://www.facebook.com/ por lo tanto, no puedes ponerlo';
		header("Location: ".www."/settings/personales");
		exit;
	}
	
} elseif(isset($_POST['ch_btn_sa'])) {
	
	$statusa = $db->query("SELECT id, username, block_newfriends FROM users WHERE id = '". $totix->user('id') ."' LIMIT 1");
	$status_sa = $statusa->fetch_assoc();

    if($status_sa['block_newfriends'] == 0) {
		$db->query("UPDATE users SET block_newfriends = '1' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado'] = 'Has bloqueado las solicitudes de amistad';
		header("Location: ".www."/settings/personales");
		exit;
	} else {
		$db->query("UPDATE users SET block_newfriends = '0' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado_bueno'] = 'Has permitido las solicitudes de amistad';
		header("Location: ".www."/settings/personales");
		exit;
	}	
} elseif(isset($_POST['ch_btn_el'])) {
	
	$statusel = $db->query("SELECT id, username, hide_online FROM users WHERE id = '". $totix->user('id') ."' LIMIT 1");
	$status_el = $statusel->fetch_assoc();

    if($status_el['hide_online'] == 0) {
		$db->query("UPDATE users SET hide_online = '1' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado'] = 'Has bloqueado que vean tu conexión';
		header("Location: ".www."/settings/personales");
		exit;
	} else {
		$db->query("UPDATE users SET hide_online = '0' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado_bueno'] = 'Has permitido que vean tu conexión';
		header("Location: ".www."/settings/personales");
		exit;
	}	
} elseif(isset($_POST['ch_btn_si'])) {
	
	$statusi = $db->query("SELECT id, username, hide_inroom FROM users WHERE id = '". $totix->user('id') ."' LIMIT 1");
	$status_si = $statusi->fetch_assoc();

    if($status_si['hide_inroom'] == 0) {
		$db->query("UPDATE users SET hide_inroom = '1' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado'] = 'Has bloqueado que puedan "seguirte" a las salas';
		header("Location: ".www."/settings/personales");
		exit;
	} else {
		$db->query("UPDATE users SET hide_inroom = '0' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado_bueno'] = 'Has permitido que puedan "seguirte" a las salas';
		header("Location: ".www."/settings/personales");
		exit;
	}	
} elseif(isset($_POST['ch_btn_in'])) {
	
	$statusin = $db->query("SELECT id, username, ignore_invites FROM users WHERE id = '". $totix->user('id') ."' LIMIT 1");
	$status_in = $statusin->fetch_assoc();

    if($status_in['ignore_invites'] == 0) {
		$db->query("UPDATE users SET ignore_invites = '1' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado'] = 'Has bloqueado que puedan enviarte invitaciones';
		header("Location: ".www."/settings/personales");
		exit;
	} else {
		$db->query("UPDATE users SET ignore_invites = '0' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado_bueno'] = 'Has permitido que puedan enviarte invitaciones';
		header("Location: ".www."/settings/personales");
		exit;
	}	
} elseif(isset($_POST['ch_mail_btn'])) {
	
	$checkmail = $db->query("SELECT id, mail FROM users WHERE mail = '". $_POST['ch_nmail'] ."' LIMIT 1");

    if(empty($_POST['ch_mail']) || empty($_POST['ch_nmail']) || empty($_POST['check_password_mail']))
    {
        $_SESSION['resultado'] = 'Dejaste algún espacio vacio, intentalo de nuevo';
		header("Location: ".www."/settings/correo");
		exit;
    }
    elseif($checkmail->num_rows > 0) 
    {
        $_SESSION['resultado'] = 'El correo electronico que intentas poner, ya esta registrado, intenta con otro';
		header("Location: ".www."/settings/correo");
		exit;
    }
    elseif($_POST['ch_mail'] != $totix->user('mail'))
    {
        $_SESSION['resultado'] = 'El correo electronico actual no es el correcto';
		header("Location: ".www."/settings/correo");
		exit;
    }
	elseif($_POST['check_password_mail'] != $_SESSION['password'])
	{
		$_SESSION['resultado'] = 'La contraseña no es la correcta';
		header("Location: ".www."/settings/correo");
		exit;
	}
    else
    {
        $db->query("UPDATE users SET mail = '". $totix->filtro($_POST['ch_nmail']) ."' WHERE id = '". $totix->user('id') ."' LIMIT 1");
        $_SESSION['resultado_bueno'] = 'Has cambiado tu correo electronico exitosamente';
		header("Location: ".www."/settings/correo");
		exit;
    }
} elseif(isset($_POST['ch_pass_btn'])) {

    if(empty($_POST['ch_pass']) || empty($_POST['ch_npass']) || empty($_POST['ch_rnpass']))
    {
        $_SESSION['resultado'] = 'Dejaste algún espacio vacio, intentalo de nuevo';
		header("Location: ".www."/settings/pass");
		exit;
    }
    elseif($_POST['ch_npass'] != $_POST['ch_rnpass'])
    {
        $_SESSION['resultado'] = 'Las contraseñas nuevas no son iguales, intenta de nuevo';
		header("Location: ".www."/settings/pass");
		exit;
    }
    elseif($_POST['ch_pass'] != $_SESSION['password'])
    {
        $_SESSION['resultado'] = 'La contraseña actual no es la correcta, intenta de nuevo';
		header("Location: ".www."/settings/pass");
		exit;
    }
    else
    {
        $db->query("UPDATE users SET password = '". $totix->hasht($_POST['ch_npass']) ."' WHERE id = '". $totix->user('id') ."' LIMIT 1");
        $_SESSION['resultado_bueno'] = 'Has cambiado tu contraseña exitosamente';
		unset($_SESSION['password']);
		$_SESSION['password'] = $_POST['ch_npass'];
		header("Location: ".www."/settings/correo");
		exit;
    }
} else {
	header("Location: ".www."");
}

?>