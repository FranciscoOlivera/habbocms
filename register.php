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

$_GET['reg_usuario'] = $_POST['reg_usuario'];
$_GET['reg_mail'] = $_POST['reg_mail'];
$_GET['reg_contrasena'] = $_POST['reg_contrasena'];
$_GET['reg_rcontrasena'] = $_POST['reg_rcontrasena'];

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="<?php echo www; ?>/styles/js/loader.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo www; ?>/bootstrap/css/bootstrap.min.css?<?php echo rand(0, 99); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/styles/index.css?<?php echo rand(0, 99); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo www; ?>/app/css/avatargenerate.css" />

        <title><?php echo name; ?> &raquo; Registrate</title>

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

<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="container">
<?php if(isset($_SESSION['reg_error'])) { echo '<div class="alert alert-danger">'. $_SESSION['reg_error'] .'</div>'; } ?>
	<div class="row">
        <div class="col-xs-6">
			<div class="panel panel-primary">
			    <div class="panel-heading">Registrate en <?php echo name; ?></div>
                <div class="panel-body">
					<form action="<?php echo www; ?>/app/submits/register_submit.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="reg_usuario" placeholder="Nuevo nombre de usuario..." value="<?php echo $_GET['reg_usuario']; ?>" maxlength="10">
                        </div>
						<div class="form-group">
                            <input type="email" class="form-control" name="reg_mail" placeholder="Correo electronico..." value="<?php echo $_GET['reg_mail']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="reg_contrasena" placeholder="Nueva contrase&ntilde;a..." value="<?php echo $_GET['reg_contrasena']; ?>">
                        </div>
						<div class="form-group">
                            <input type="password" class="form-control" name="reg_rcontrasena" placeholder="Repite nueva contrase&ntilde;a..." value="<?php echo $_GET['reg_rcontrasena']; ?>">
                        </div>
						<div class="form-group">
						    <div class="g-recaptcha" data-sitekey="6LciIQoTAAAAALuOnRiohhkqluvjKCiive6A4Qda"></div>
						</div>	
											
					    <input type="submit" class="btn btn-primary" value="&iexcl;Unirme a la diversi&oacute;n de <?php echo name; ?>!" /> <a style="float: right;" href="<?php echo www; ?>" class="btn btn-danger">He decidido no registrarme :(</a>
                </div>
		    </div>
			
			<div class="panel panel-default">
			    <div class="panel-heading">&Uacute;ltimos registrados</div>
                <div class="panel-body">
				
				    <?php
					$sql_last = $db->query("SELECT * FROM users ORDER BY id DESC LIMIT 3");
					while($last = $sql_last->fetch_assoc()) {
					?>
					
					<div class="col-xs-1" style="margin-right: 0px;">
					    <img src="<?php echo avatar . $last['look']; ?>&direction=3&head_direction=3&gesture=sml&size=b&img_format=gif&headonly=1" />
					</div>
					<div class="col-xs-3" style="text-align: right;">
					    <b><?php echo $last['username']; ?></b>
						<br />
						<i><?php echo $totix->getlast($last['date_created']); ?></i>
					</div>
					
					<?php } ?>
				
				</div>
		    </div>
		</div>	
		
		<div class="col-xs-6">
			<div class="panel panel-success">
			    <div class="panel-heading">Crea tu avatar</div>
                <div class="panel-body">
				    <div class="alert alert-success">&iexcl;T&uacute; avatar podran verlo otros usuarios, eligue bien y ponte a la moda!</div>
				    <div id="avatarSelector" class="builder-viewport">

                        <!-- Main Navigation -->
                        <div class="main-navigation">

                            <ul>
                                <li class="active">
                                    <a href="#" data-navigate="hd" data-subnav="gender"><img src="./app/img/body.png" /></a>
                                </li>

                                <li>
                                    <a href="#" data-navigate="hr" data-subnav="hair"><img src="./app/img/hair.png" /></a>
                                </li>

                                <li>
                                    <a href="#" data-navigate="ch" data-subnav="tops"><img src="./app/img/tops.png" /></a>
                                </li>

                                <li>
                                    <a href="#" data-navigate="lg" data-subnav="bottoms"><img src="./app/img/bottoms.png" /></a>
                                </li>

                                <li>
                                    <a href="#"><img src="./app/img/saved-looks.png" /></a>
                                </li>
                            </ul>

                        </div>
                        <!-- End Main Navigation -->

                        <!-- Sub Navigation -->
                        <div class="sub-navigation">

                            <ul id="gender" class="display">

                                <li>
                                    <a href="#" class="male nav-selected" data-gender="M"></a>
                                </li>

                                <li>
                                    <a href="#" class="female" data-gender="F"></a>
                                </li>
                            </ul>

                            <ul id="hair" class="hidden">

                                <li>
                                    <a href="#" class="hair nav-selected" data-navigate="hr"></a>
                                </li>

                                <li>
                                    <a href="#" class="hats" data-navigate="ha"></a>
                                </li>

                                <li>
                                    <a href="#" class="hair-accessories" data-navigate="he"></a>
                                </li>

                                <li>
                                    <a href="#" class="glasses" data-navigate="ea"></a>
                                </li>

                                <li>
                                    <a href="#" class="moustaches" data-navigate="fa"></a>
                                </li>


                            </ul>

                            <ul id="tops" class="hidden">

                                <li>
                                    <a href="#" class="tops nav-selected" data-navigate="ch"></a>
                                </li>

                                <li>
                                    <a href="#" class="chest" data-navigate="cp"></a>
                                </li>

                                <li>
                                    <a href="#" class="jackets" data-navigate="cc"></a>
                                </li>

                                <li>
                                    <a href="#" class="accessories" data-navigate="ca"></a>
                                </li>
                            </ul>

                            <ul id="bottoms" class="hidden">

                                <li>
                                    <a href="#" class="bottoms nav-selected" data-navigate="lg"></a>
                                </li>

                                <li>
                                    <a href="#" class="shoes" data-navigate="sh"></a>
                                </li>

                                <li>
                                    <a href="#" class="belts" data-navigate="wa"></a>
                                </li>

                            </ul>

                        </div>
                        <!-- End Sub Navigation -->


                        <div id="clothes-colors">
                            <div id="clothes"></div>
                            <div id="colors"></div>
                        </div>


                        <div id="avatar">

                            <img id="myHabbo" src="" alt="My Habbo" title="My Habbo" />

                            <input type="hidden" name="habbo-avatar" id="avatar-code">

                        </div>

                    </div>

                    </form>
				</div>
			</div>
		</div>
	</div>
	
</div>	

<?php include 'includes/footer.php'; ?>
	
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo www; ?>/app/js/jquery.avatargenerate.min.js" type="text/javascript"></script>
	
</body>
</html>
<?php if(isset($_SESSION['reg_error'])) { unset($_SESSION['reg_error']); } ?>