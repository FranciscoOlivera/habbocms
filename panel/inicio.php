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
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/bootstrap.min.css?sdf" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/style.css" />

        <title><?php echo name; ?> &raquo; Panel de administración</title>

    </head>
<body>

    <?php include_once 'includes/nav.php'; ?>

    <div class="container-fluid">
      <div class="row">
	  
        <?php include_once 'includes/sidebar.php'; ?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		    <div class="alert alert-danger"><b><span class="glyphicon glyphicon-bullhorn"></span> Atención:</b> El panel de administración esta en su fase beta, pronto estara en su fase completa, por lo tanto no le sirven muchas herramientas.</div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Información básica del hotel</h3>
                </div>
	            <div class="panel-body">
                    <div class="row placeholders">
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <h1><span class="glyphicon glyphicon-user"></span></h1>
                            <h4><?php $usuarios = $db->query("SELECT * FROM users"); echo $usuarios->num_rows; ?></h4>
                            <span class="text-muted">Usuarios registrados</span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <h1><span class="glyphicon glyphicon-exclamation-sign"></span></h1>
                            <h4><?php $bans = $db->query("SELECT * FROM bans"); echo $bans->num_rows; ?></h4>
                            <span class="text-muted">Usuarios baneados</span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <h1><span class="glyphicon glyphicon-home"></span></h1>
                            <h4><?php $rooms = $db->query("SELECT * FROM rooms"); echo $rooms->num_rows; ?></h4>
                            <span class="text-muted">Salas creadas</span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <h1><span class="glyphicon glyphicon-list-alt"></span></h1>
                            <h4><?php $news = $db->query("SELECT * FROM cms_news"); echo $news->num_rows; ?></h4>
                            <span class="text-muted">Noticias creadas</span>
                        </div>
                    </div>
					
					<hr />
					
					<div class="col-xs-6">
					    <div class="well well-sm">
						    <h2>Últimos movimientos del panel</h2>
							<div class="scroll">
							  <table class="table table-bordered">
							    <tbody>
								<tr>
								    <td><b>Acción</b></td><td><b>Usuario</b></td><td><b>Fecha</b></td>
								</tr>
							    <?php
							    $sql_mov = $db->query("SELECT * FROM stafflogs ORDER BY id DESC LIMIT 100");
							    while($mov = $sql_mov->fetch_assoc()) 
							    {
									$movv_u = $db->query("SELECT id, username, look FROM users WHERE id = '". $mov['userid'] ."' LIMIT 1");
									$mov_u = $movv_u->fetch_assoc();
									
									if($mov['action'] == 'Mod')
									{
										$color = 'warning';
									}
									elseif($mov['action'] == 'Del')
									{
										$color = 'danger';
									}
									elseif($mov['action'] == 'Crea')
									{
										$color = 'success';
									}
									elseif($mov['action'] == 'Logeo')
									{
										$color = 'active';
									}
							    ?>						
                                    <tr class="<?php echo $color; ?>">
									    <td><b><?php echo $mov['message']; ?></b></td><td><img src="<?php echo avatar . $mov_u['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /> <u><?php echo $mov_u['username']; ?></u></td><td><i><?php echo date('d/m/Y', $mov['timestamp']); ?></i></td>									
									</tr>
							    <?php } ?>
								</tbody>
                              </table>
							</div>
						</div>
					</div>
					
					<div class="col-xs-6">
					    <div class="well well-sm">
						    <h2>Últimos movimientos del cliente</h2>
							<div class="scroll">
							  <table class="table table-bordered">
							    <tbody>
								<tr>
								    <td><b>Acción</b></td><td><b>Usuario</b></td><td><b>Fecha</b></td>
								</tr>
							    <?php
							    $sql_movc = $db->query("SELECT * FROM logs_client_staff ORDER BY id DESC LIMIT 100");
							    while($movc = $sql_movc->fetch_assoc()) 
							    {
									$movv_cu = $db->query("SELECT id, username, look FROM users WHERE id = '". $movc['user_id'] ."' LIMIT 1");
									$mov_cu = $movv_cu->fetch_assoc();
							    ?>						
                                    <tr>
									    <td><b>:<?php echo $movc['data_string']; ?></b></td><td><img src="<?php echo avatar . $mov_cu['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /> <u><?php echo $mov_cu['username']; ?></u></td><td><i><?php echo date('d/m/Y', $movc['timestamp']); ?></i></td>									
									</tr>
							    <?php } ?>
								</tbody>
                              </table>
							</div>
						</div>
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