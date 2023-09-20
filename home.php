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

$id_u = $totix->filtro($_GET['id']);

if(!empty($id_u) && isset($id_u))
{
	$sql_perfil = $db->query("SELECT * FROM users WHERE username = '". $id_u ."' LIMIT 1");
	if($sql_perfil->num_rows > 0)
	{
		$perfil = $sql_perfil->fetch_assoc();
	}
	else
	{
		$error = 'El perfil que solicitas no existe';
		$perfil['username'] = 'No existe';
	}
}
else
{
	header("Location: ".www."/home/".$totix->user('username')."");
}

$pageme = null;
$queryact = "SELECT * FROM cms_actividad WHERE userid = '" . $perfil['id'] ."' ORDER BY id DESC";
$pagina = 'home';
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

        <title><?php echo name; ?> &raquo; <?php echo $perfil['username']; ?></title>

    </head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="container">
<?php 
if(isset($_SESSION['port_error'])) { echo '<div class="alert alert-danger">'.$_SESSION['port_error'].'</div>'; }
if(isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } else { 
?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
			<?php include_once 'includes/add-perfil.php'; ?>
		</div>	
	</div>
	<div class="row">
	    <div class="col-xs-12 col-sm-4 col-md-4 hidden-xs">
		    <?php include_once 'includes/add-perfil-photos.php'; ?>
		    <?php include_once 'includes/add-perfil-amigos.php'; ?>
		    <?php include_once 'includes/add-perfil-salas.php'; ?>		
			<?php include_once 'includes/add-perfil-placas.php'; ?>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8">
		    <?php include_once 'includes/add-actividad.php'; ?>
		</div>
    </div>		
<?php } ?>
</div>	
<?php include 'includes/footer.php'; ?>		

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js?asd"></script>
<script type="text/javascript" src="<?php echo www; ?>/styles/js/buscador.js"></script>
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js?asd"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>

</body>
</html>
<?php if(isset($_SESSION['port_error'])) { unset($_SESSION['port_error']); } ?>