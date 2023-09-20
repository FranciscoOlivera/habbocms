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

$comment_new = $totix->bbcode($_POST['comentario']);
$comment_del = $totix->filtro($_POST['delete']);
$id_comment =  $totix->filtro($_SESSION['id_new']);

if(isset($comment_del) && is_numeric($comment_del))
{
	$db->query("DELETE FROM cms_comments_news WHERE id = '". $comment_del ."' AND added_by = '". $totix->user('id') ."' LIMIT 1");
	header("Location: ".www."/news/".$id_comment."#comentarios");
	exit;
}
elseif(isset($comment_new))
{
	if(empty($comment_new))
	{
		$_SESSION['comment_error'] = 'No dejes el espacio en blanco';
		header("Location: ".www."/news/".$id_comment."#comentarios");
		exit;
	}
	else
	{
	    $db->query("INSERT INTO cms_comments_news (comentario, notice_id, added_by, added_date) VALUES('". $comment_new ."', '". $id_comment ."', '". $totix->user('id') ."', '". $totix->fecha('normal') ."')");
	    header("Location: ".www."/news/".$id_comment."#comentarios");
	    exit;
	}
} else {
	header("Location: ".www."");
}

?>