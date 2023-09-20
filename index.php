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
$totix->checklogged('yes');	
$totix->banned();	
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="<?php echo www; ?>/styles/js/loader.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo www; ?>/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 9999); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/index.css?<?php echo rand(0, 9999); ?>" />

        <title><?php echo name; ?></title>

    </head>
<body>

<span id="loadPage">
    <center><img src="<?php echo logo; ?>" /></center>
</span>

<div class="container largo">
    <img class="logo" src="<?php echo logo; ?>" />
	<div class="onlines">
		<div class="panel panel-success">
            <div class="panel-body">
                <?php echo $totix->onlines(); ?>
            </div>
		</div>
	</div>
</div>

<div class="container">
<?php if(isset($_SESSION['login_error'])) { echo '<div class="alert alert-danger">'. $_SESSION['login_error'] .'</div>'; } ?>
	<div class="row">
        <div class="col-xs-6">
			<div class="panel panel-primary">
			    <div class="panel-heading">Ingresa a <?php echo name; ?></div>
                <div class="panel-body">
					<form action="<?php echo www; ?>/app/submits/login_submit.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Nombre de usuario...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña...">
                        </div>
						<input type="submit" class="btn btn-primary btn-block" value="¡Qué empiece la diversión!">
					</form>
                </div>
		    </div>
		</div>	
		
		<div class="col-xs-6">
			<div class="panel panel-success">
			<div class="panel-heading">¿Es tu primera vez por aquí?</div>
                <div class="panel-body">
				<div class="alert alert-success">Si eres nuev@ y quieres conocer la diversión, unete a nosotros</div>
				    Su primera impresión del hotel es siempre lo más importante, por lo que nos gustaría ayudarle con una breve descripción. <?php echo name; ?> es un mundo virtual donde puedes divertirte, jugar, construír y conocer a otra personas alrededor del mundo aparte de, <?php echo name; ?> tiene todo lo que estás buscando.
					<br /><br />
					<a href="/register" class="btn btn-success btn-lg btn-block" role="button">¡Registrate!</a>
				</div>
			</div>
		</div>
	</div>
</div>	

<?php include 'includes/footer.php'; ?>
	
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>
	
</body>
</html>
<?php if(isset($_SESSION['login_error'])) { unset($_SESSION['login_error']); } ?>