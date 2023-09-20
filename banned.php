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

require_once 'engine/funciones.php';

$sqldatos = $db->query("SELECT * FROM bans WHERE value = '". $totix->user('username') ."' OR value = '". $totix->ip() ."' LIMIT 1");
			
if($sqldatos->num_rows < 1)
{
	header("Location: /");
	exit;
} else {
    $Ban = $sqldatos->fetch_assoc();
}

if(time() > $Ban['expire']) 
{
	$db->query("DELETE FROM bans WHERE value = '". $totix->user('username') ."' OR value = '". $totix->ip() ."' LIMIT 1");
	header("Location: /");
	exit;
}
?>
<html>
    <head>
		<title><?php echo name; ?> &raquo; Baneado</title>
		<link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/styles/banerror.css?<?php echo rand(0, 999999); ?>" />
	</head>
	<body>
		<div class="modal">
			<a href="/"><img src="/app/images/minilogo.png" style="float: left; margin: -58px -63px;"></a>
			<div class="header">
				Al parecer has sido baneado de <?php echo name; ?>
			</div>
			<div class="content">
				<?php echo $Ban['reason']; ?>
				<br /><br />
				Atte: <b><?php echo $Ban['added_by']; ?></b>
			</div>
			<div class="actions">
				<a>Termina el día: <?php echo $totix->fecha_dat($Ban['expire']); ?></a><a class="success" style="border:1px solid #B40404; color:#B40404;" href="/logout">Salir</a>
			</div>
			<div class='loader-bar'>
					<div class='bar' style="background: #B40404;"></div>
			</div>
		</div>
	</body>
</html>
