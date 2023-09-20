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

$like_new = $totix->filtro($_POST['like']);
$id_like = $totix->filtro($_SESSION['id_new']);

if(is_numeric($like_new))
{
	$db->query("INSERT INTO cms_news_likes (notice_id, added_by_id) VALUES('". $like_new ."', '". $totix->user('id') ."')");
	header("Location: ".www."/news/".$id_like."");
	exit;
}
elseif($like_new = 'dislike')
{
    $db->query("DELETE FROM cms_news_likes WHERE notice_id = '".$id_like."' AND added_by_id = '". $totix->user('id') ."' LIMIT 1");
	header("Location: ".www."/news/".$id_like."");
	exit;
} else {
	header("Location: ".www."");
}

?>