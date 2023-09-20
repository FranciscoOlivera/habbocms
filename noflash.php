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
$totix->checklogged('no');
$totix->banned();
?>
<html lang="en">
<head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo name; ?> &raquo; ¡Oops!</title>
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/style.css?<?php echo rand(0, 999999); ?>" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<style>
		#clienterror{
			color:#FFFFFF;
			background:#000000;
			font-family:'Ubuntu Light';
			padding:48px 12px;
			width:100%;
			height:100%;
			position:fixed;
			top:0;
			left:0;
			text-align:center;
			z-index:1000000;
		}
		#clienterror p{
			width:445px;
			margin:0 auto;
			font-family:'Ubuntu Light';
			font-size:24px;
			text-align:center;
			padding:20px 0;
		}
		#clienterror a{
			margin:0 auto;
			margin-bottom:10px;
			display:block;
		}
		#clientdcerror{
			color:#FFFFFF;
			background:#000000;
			background:rgba(0,0,0,0.85);
			font-family:'Ubuntu Light';
			padding:48px 12px;
			width:100%;
			height:100%;
			display:none;
			position:fixed;
			top:0;
			left:0;
			text-align:center;
			z-index:1000000;
			}
		#clientdcerror p{
			width:445px;
			margin:0 auto;
			font-family:'Ubuntu Light';
			font-size:24px;
			text-align:center;
			padding:20px 0;
		}
		#clientdcerror a{
			margin:0 auto;
			margin-bottom:10px;
			display:block;
		}
	</style>
	<div id="clienterror">
		<p>¡Oh no!<br/><br/>No se pudo activar Adobe Flash Player en tu navegador.<br/><br/>Puedes intentar activar Flash Player usando el botón de abajo o descargándolo desde la página de Adobe.</p>
		<a href="http://www.adobe.com/go/getflashplayer"><img src="<?php echo www; ?>/app/images/flash.png" onmouseover="" style="cursor: pointer;"></a>
	</div>
</body>
</html>