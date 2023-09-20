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

if(isset($_SESSION['hk_loged'])) 
{ 
    header("Location: ".www . panel ."/inicio.php"); 
} 

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/bootstrap.min.css?sdf" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/style.css?asd" />

        <title><?php echo name; ?> &raquo; Panel de administración</title>

    </head>
<body>

<div class="container">
    <?php if(isset($_SESSION['hk_error'])) { echo '<div class="alert alert-danger">' . $_SESSION['hk_error'] . '</div>'; } ?>
	<div class="row">
        <div class="col-xs-12">
			<div class="panel panel-default">
	            <div class="panel-body">
				    <div class="col-xs-6">
					    <img class="logo-index" src="<?php echo logo; ?>" />
	                    <a href="<?php echo www; ?>" class="btn btn-warning btn-block">&laquo; Volver a la página principal</a>
						<h1>Ingresa a la administración <br /><small>todo lo que hagas dentro sera registrado</small></h1>
					    <hr />
						<form action="<?php echo www; ?>/app/submits/hk_submit.php" method="POST">
						    <div class="form-group">
                                <input type="text" class="form-control" name="hk_username" placeholder="Nombre de usuario" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="hk_password" placeholder="Contraseña" autocomplete="off">
                            </div>
							<div class="form-group">
                                <input type="text" class="form-control" name="hk_pin" placeholder="PIN de seguridad (4 dígitos)" maxlength="4" autocomplete="off">
                            </div>
							<button type="submit" name="hk_submit" class="btn btn-success btn-block">¡VAMOS A ADMINISTRAR! &raquo;</button>
						</form>
						<br /><br />
						<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> <b>Atención:</b> Esta es una herramienta muy importante, capaz de modificar cosas valiosas del hotel, usala con responsabilidad, todo lo que hagas en ella sera registrado en una base de datos, así que ten <b>cuidado</b></div>
					</div>
					<div class="col-xs-6">
                        <img src="<?php echo www; ?>/panel/assets/images/index-image.png" />
					</div>
	            </div>
            </div>	
		</div>		
	</div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php if(isset($_SESSION['hk_error'])) { unset($_SESSION['hk_error']); } ?>