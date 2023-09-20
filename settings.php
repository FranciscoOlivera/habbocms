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

$ajuste = $totix->filtro($_GET['accion']);

if(empty($ajuste) || !isset($ajuste))
{
	header("Location: ".www."/settings/personales");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo www; ?>/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 99); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/style.css?<?php echo rand(0, 99); ?>" />

        <title><?php echo name; ?> &raquo; Ajustes</title>

    </head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="container">
<?php 
if(isset($_SESSION['resultado'])) { echo '<div class="alert alert-danger">'.$_SESSION['resultado'].'</div>'; 
} elseif(isset($_SESSION['resultado_bueno'])) { echo '<div class="alert alert-success">'.$_SESSION['resultado_bueno'].'</div>'; } 
?>
    <div class="row">
        <div class="col-xs-4">
			<?php include_once 'includes/add-ajustes-lista.php'; ?>
		</div>	
		<div class="col-xs-8">
		    <?php 
			if($ajuste == 'personales') {
	            include_once 'includes/add-ajustes-personales.php';
            } elseif($ajuste == 'correo') {
	            include_once 'includes/add-ajustes-correo.php';
            } elseif($ajuste == 'pass') {
	            include_once 'includes/add-ajustes-pass.php';
            } else {
				echo '<div class="alert alert-danger">¡Escoje una categoria, ya que esta no existe!</div>';
			}
			?>
		</div>
    </div>
</div>	

<?php include 'includes/footer.php'; ?>		

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js?asd"></script>
<script type="text/javascript" src="<?php echo www; ?>/styles/js/buscador.js"></script>
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php if(isset($_SESSION['resultado']) || isset($_SESSION['resultado_bueno'])) { unset($_SESSION['resultado']); unset($_SESSION['resultado_bueno']); } ?>