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
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo www; ?>/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 999999); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/style.css?<?php echo rand(0, 999999); ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />		
		<style>
		.photos {
			margin-bottom: 10px;
		}
		</style>

        <title><?php echo name; ?> &raquo; Fotos</title>

    </head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="container">
    <div class="alert alert-info">
        <p class="text-center">Echa un vistazo a algunos de los grandes momentos inmortalizados por por la cámara <?php echo name; ?> <span class="glyphicon glyphicon-camera"></span></p>
    </div>
	
    <div class="row">
	    <?php include_once 'includes/add-photos.php'; ?>
	</div>
</div>	
	
<?php include 'includes/footer.php'; ?>		
	
<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js?asd"></script> 
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js?Asd"></script>
<script type="text/javascript" src="<?php echo www; ?>/styles/js/buscador.js?Asd"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>

</body>
</html>