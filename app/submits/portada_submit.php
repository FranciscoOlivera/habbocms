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

if($_FILES['portada']['error'] > 0) {
	$_SESSION['port_error'] = 'Un error ha ocurrido';
	header("Location: ".www."/home/".$totix->user('username')."");
	exit;
}
else
{
	$sep = explode('image/', $_FILES['portada']['type']);
    $tipo = $sep[1];
	
	if($tipo == 'png' || $tipo == 'jpg' || $tipo == 'jpeg') {
		
		$nombres = $totix->user('id') . '-' . time();
		$tipos = substr($_FILES['portada']['type'], 6);
		
		$ruta = "portadas_subidas/".$nombres.'.'.$tipos;
			
	    $resultado = @move_uploaded_file($_FILES['portada']['tmp_name'], $ruta);
		if($resultado) {
			$db->query("UPDATE users SET portada = '/app/submits/".$ruta."' WHERE id = '". $totix->user('id') ."' LIMIT 1");
			$db->query("INSERT INTO cms_actividad SET type = 'portada', userid = '". $totix->user('id') ."', portadalink = '/app/submits/".$ruta."', timestamp = '" . time() . "'");
			header("Location: ".www."/home/".$totix->user('username')."");
			exit;
		} else {
			$_SESSION['port_error'] = 'Ocurrio un error al subir el archivo';
			header("Location: ".www."/home/".$totix->user('username')."");
			exit;
		}
		
	} else {
		$_SESSION['port_error'] = 'Este tipo de archivos no esta permitido';
		header("Location: ".www."/home/".$totix->user('username')."");
		exit;
	}
}

?>