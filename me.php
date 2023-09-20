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

$sql_rank = $db->query("SELECT * FROM ranks WHERE id = '". $totix->user('rank') ."' LIMIT 1");
$rank = $sql_rank->fetch_assoc();

$pageme = 'hola pinche putita no borres esta variable';
$queryact = "SELECT * FROM cms_actividad ORDER BY id DESC";
$pagina = 'me';
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

        <title><?php echo name; ?> &raquo; <?php echo $totix->user('username'); ?></title>

    </head>
<body onload="myLoader()">

<?php include 'includes/nav.php'; ?>

<div class="container">
	<div class="row">
        <div class="col-xs-12 col-sm-3">
			<?php include_once 'includes/add-money.php'; ?>
		</div>	
		
		<div class="col-xs-12 col-sm-9">
			<?php include_once 'includes/add-me.php'; ?>		    
		</div>
	</div>
	<div class="row">
        <div class="col-xs-12 col-sm-4">
		    <?php include_once 'includes/add-actividad-aviso.php'; ?>
			<?php include_once 'includes/add-promos-list.php'; ?>
			<?php include_once 'includes/add-salas.php'; ?>
			<?php include_once 'includes/add-fb.php'; ?>
		</div>
		
		<div class="col-xs-12 col-sm-8">
		<div id="loader"></div>
		    <div class="animate-bottom"  style="display:none;" id="loaded">
		        <?php include_once 'includes/add-actividad.php'; ?>
			</div>
		</div>
	</div>	
</div>	
	
<?php include 'includes/footer.php'; ?>	

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js?asd"></script>
<script type="text/javascript" src="<?php echo www; ?>/styles/js/buscador.js"></script>
<script type="text/javascript" src="<?php echo www; ?>/styles/js/loader2.js"></script>
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php if(isset($_SESSION['aviso_error'])) { unset($_SESSION['aviso_error']); unset($pageme); } ?>