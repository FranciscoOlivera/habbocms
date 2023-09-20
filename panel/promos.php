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

require_once '../engine/funciones.php';
$totix->checklogged('no');
$totix->banned();
$totix->checkrank('sin-acceso');

if(!isset($_SESSION['hk_loged'])) 
{ 
    header("Location: ".www . panel .""); 
} 
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/bootstrap.min.css?sdf" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/style.css" />
		
        <title>Elige una imagen</title>
    
	</head>
<body style="overflow-x: hidden;">
<div class="alert alert-danger" style="width: 760px;"><b><span class="glyphicon glyphicon-bullhorn"></span> Atención:</b> Selecciona una imagen y arrastrala al campo de "imagen", una vez ahí la URL de la imagen, se pondra automaticamente</div>
<br /><br />
<?php
    $directory = '../app/images/promos';
    $dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false)
    {
        if(is_file($directory."/".$archivo)) {
            echo '<img src="'.$directory."/".$archivo.'"><hr />';
        }
    }
    $dirint->close();
?>
</body>
</html>