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

if(isset($_POST['submit_c'])) 
{
	if(empty($_POST['titlec']) || empty($_POST['shortstoryc']) || empty($_POST['longstoryc']) || empty($_POST['imagec']))
	{
		$_SESSION['new_error'] = 'No dejes espacios en blanco';
		header("Location: ". www . panel ."/news.php?action=new");
		exit;
	}
	else
	{
		$db->query("INSERT INTO cms_news (title, image, shortstory, longstory, author, date) VALUES ('". $totix->filtro($_POST['titlec']) ."', '". $totix->filtro($_POST['imagec']) ."', '". $totix->filtro($_POST['shortstoryc']) ."', '". $_POST['longstoryc'] ."', '". $totix->user('username') ."', '". time() ."')");
		$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Crea', 'Creo una noticia (". $totix->filtro($_POST['titlec']) .")', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
		$db->query("INSERT INTO cms_actividad (userid, type, articuloid, timestamp) VALUES ('".$totix->user('id')."', 'articulo', '".time()."', '".time()."')");
		$_SESSION['new_resultado'] = 'Has creado la noticia exitosamente';
		header("Location: ". www . panel ."/news.php");
		exit;
	}
}
elseif(isset($_POST['submit_m'])) 
{
	$checkexiste = $db->query("SELECT * FROM cms_news WHERE id = '". $totix->filtro($_POST['idm']) ."' LIMIT 1");
	
	if(empty($_POST['titlem']) || empty($_POST['shortstorym']) || empty($_POST['longstorym']) || empty($_POST['imagem']))
	{
		$_SESSION['new_error'] = 'No dejes espacios en blanco';
		header("Location: ". www . panel ."/news.php");
		exit;
	}
	elseif($checkexiste->num_rows > 0) 
	{
		$db->query("UPDATE cms_news SET title = '". $totix->filtro($_POST['titlem']) ."', image = '". $totix->filtro($_POST['imagem']) ."', shortstory = '". $totix->filtro($_POST['shortstorym']) ."', longstory = '". $_POST['longstorym'] ."', author = '". $totix->user('username') ."' WHERE id = '". $totix->filtro($_POST['idm']) ."' LIMIT 1");
		$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Mod', 'Modifico una noticia (". $totix->filtro($_POST['titlem']) .")', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
		$_SESSION['new_resultado'] = 'Has actualizado la noticia exitosamente';
		header("Location: ". www . panel ."/news.php");
		exit;
	}
	else
	{
		$_SESSION['new_error'] = 'La noticia que intentas modificar, no existe';
		header("Location: ". www . panel ."/news.php");
		exit;
	}
}
elseif(isset($_POST['submit_del']))
{
	$checkn = $db->query("SELECT * FROM cms_news WHERE id = '". $_POST['submit_del'] ."' LIMIT 1");
	$chekeer = $checkn->fetch_assoc();
	
	if($checkn->num_rows > 0)
	{
		$db->query("DELETE FROM cms_news WHERE id = '". $_POST['submit_del'] ."' LIMIT 1");
		$db->query("DELETE FROM cms_actividad WHERE articuloid = '". $chekeer['date'] ."' LIMIT 1");
		$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Del', 'Borro una noticia', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
		$_SESSION['new_resultado'] = 'Has borrado la noticia exitosamente';
		header("Location: ". www . panel ."/news.php");
		exit;
	}
	else
	{
		$_SESSION['new_error'] = 'La noticia que intentas borrar no existe';
		header("Location: ". www . panel ."/news.php");
		exit;
	}
}
else
{
	header("Location: ". www . panel ."/news.php");
}
?>