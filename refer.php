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

require_once './engine/funciones.php';

if(isset($_GET['r']) && !empty($_GET['r']) {

	$r = $totix->filtro($_GET['r']);

	$sql = $db->query("SELECT * FROM users WHERE ip_last = '" . $totix->ip() . "'");
	$sql1 = $db->query("SELECT * FROM users_referidos WHERE ip_referida = '". $totix->ip() ."'");
	$sql2 = $db->query("SELECT * FROM users WHERE username = '". $r ."'");

	if($sql->num_rows > 0) {
		header("Location: /");
		exit;
	} elseif($sql1->num_rows > 0) {
        header("Location: /");
        exit;
	} elseif($sql2->num_rows == 0) {
		header("Location: /");
		exit;
	} else {
	    $db->query("INSERT INTO users_referidos (usuario, ip_referida, fecha) VALUES ('". $r ."', '". $totix->ip() ."', '". time() ."')");
	    header("Location: /register");
		exit;
	}
} else {
	header("Location: /");
	exit;
}
?>