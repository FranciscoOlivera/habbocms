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
$totix->checkrank('maxrank');

if(!isset($_SESSION['hk_loged'])) 
{ 
    header("Location: ".www . panel ."");
    exit; 	
} 

if(isset($_POST['rank_submit'])) 
{
	$getuser = $db->query("SELECT * FROM users WHERE username = '". $totix->filtro($_POST['user_rank']) ."' LIMIT 1");
	
	if(empty($_POST['user_rank']))
	{
		$_SESSION['rank_error'] = 'No dejes los campos vacios';
		header("Location: ". www . panel ."/ranks.php");
		exit;
	}
	elseif($getuser->num_rows < 1)
	{
		$_SESSION['rank_error'] = 'El usuario al que le quieres dar rango, no existe';
		header("Location: ". www . panel ."/ranks.php");
		exit;
	}
	elseif($_POST['user_rank'] == $_SESSION['username'])
	{
		$_SESSION['rank_error'] = 'No te puedes dar rango a ti mismo';
		header("Location: ". www . panel ."/ranks.php");
		exit;
	}
	elseif($_POST['rank_rank'] > $totix->user('rank')) // Por: B4n
	{
		$_SESSION['rank_error'] = 'No puedes dar un rango más alto que el tuyo';
		header("Location: ". www . panel ."/ranks.php");
		exit;
	}
	else
	{
		$db->query("UPDATE users SET rank = '" . $totix->filtro($_POST['rank_rank']) ."' WHERE username = '". $totix->filtro($_POST['user_rank']) ."' LIMIT 1");;
		$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Mod', 'Ah modificado el rango de ". $totix->filtro($_POST['user_rank']) ."', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
	    $_SESSION['rank_ok'] = 'Has dado rango a un usuario exitosamente';
		header("Location: ". www . panel ."/ranks.php");
		exit;
	}
}
else
{
	header("Location: ". www . panel ."/news.php");
}

?>