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

$aviso_new = $totix->bbcode($_POST['aviso']);
$aviso_del = $totix->filtro($_POST['delete']);

if(isset($aviso_del) && is_numeric($aviso_del))
{
	$db->query("DELETE FROM cms_actividad WHERE id = '". $aviso_del ."' AND userid = '". $totix->user('id') ."' LIMIT 1");
	header("Location: ".www."/".$_POST['location']."#avisos");
	exit;
}
elseif(isset($aviso_new))
{
	if(empty($aviso_new))
	{
		$_SESSION['aviso_error'] = 'No dejes el espacio en blanco';
		header("Location: ".www."/me#avisos");
		exit;
	}
	elseif($totix->user('rank') < hkmin)
	{
		$_SESSION['aviso_error'] = 'No puedes realizar esta acción';
		header("Location: ".www."/me#avisos");
		exit;
	}
	else
	{
	    $db->query("INSERT INTO cms_actividad (userid, type, contenido, timestamp) VALUES('". $totix->user('id') ."', 'aviso', '". $aviso_new ."', '". time() ."')");
	    header("Location: ".www."/me#avisos");
	    exit;
	}
} else {
	header("Location: ".www."");
}

?>