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

$sql_referidos = $db->query("SELECT * FROM users_referidos WHERE usuario = '". $totix->user('username') ."'");
$r = $sql_referidos->num_rows;

$page = "comunidad";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js?asd"></script> 
		<script type="text/javascript" src="<?php echo www; ?>/styles/js/buscador.js"></script>
		<script type="text/javascript" src="<?php echo www; ?>/styles/js/jquery.tipTip.minified.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo www; ?>/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 99); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/style.css?<?php echo rand(0, 99); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/tipTip.css">
		<script type="text/javascript">
		$(function(){
			$(".tiptip").tipTip();
		});
	    </script>

        <title><?php echo name; ?> &raquo; Comunidad</title>

    </head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-xs-6">
			<?php include_once 'includes/add-usuariosazar.php'; ?>
		</div>	
		<div class="col-xs-6">
		    <?php include_once 'includes/add-referidos.php'; ?>
		</div>
	</div>
	<div class="row">
		<?php include_once 'includes/add-tops.php'; ?>	
	</div>
</div>	

<?php include 'includes/footer.php'; ?>	

<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php unset($page); ?>