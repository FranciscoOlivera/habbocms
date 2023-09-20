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
		    <?php if(isset($_SESSION['ban_error'])) { echo '<div class="alert alert-danger">' . $_SESSION['ban_error'] .'</div>'; } elseif(isset($_SESSION['ban_resultado'])) { echo '<div class="alert alert-success">' . $_SESSION['ban_resultado'] .'</div>'; } ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Administración de baneos</h3>
                </div>
	            <div class="panel-body">
                    <div class="col-xs-12">
					    <div class="well well-sm">
						  <div class="alert alert-danger"><b><span class="glyphicon glyphicon-bullhorn"></span> Atención:</b> La herramienta de baneo es donde podras darle acceso o quitarle el acceso a un usuario, dependiendo su comportamiento, usala con responsabilidad y adecuadamente.</div>
						  <form action="submits/submit_bans.php" method="POST">
						    <div class="form-group">
                                <label for="ban_user">Usuario a banear</label>
                                <input type="text" class="form-control" name="ban_user" id="ban_user" placeholder="Ej: B4n">
                            </div>
							<label for="ban_time">Tiempo</label>
						    <div class="form-group">
							    <div class="col-lg-6">
                                    <input type="text" class="form-control" id="ban_time" name="ban_time" placeholder="¿Cuánto tiempo? (digítos)">
                                </div>
                                <div class="col-lg-6">
                                    <select name="ban_format" class="form-control">
									    <option value="horas">Hora(s)</option>
									    <option value="dias">Día(s)</option>
										<option value="meses">Mes(es)</option>
										<option value="anios">Año(s)</option>
									</select>
                                </div>
                            </div>
							<div class="form-group">
                                <label for="ban_reason">Razón</label>
                                <textarea class="form-control" name="ban_reason" id="ban_reason" rows="3"></textarea>
                            </div>
							<button type="submit" name="ban_submit" class="btn btn-danger btn-block">¡Banear usuario!</button>
						  </form>
						</div>
					</div>
					<div class="col-xs-12">
					    <div class="well well-sm">
						    <h2>Usuarios baneados</h2>
							<hr />
						    <table class="table table-bordered">
                                <tr>
								    <td><b>Usuario</b></td><td><b>Razón</b></td><td><b>Baneado por</b></td><td><b>Baneado el día</b></td><td><b>Expira</b></td><td width="100"><b>Acción</b></td>
								</tr>
								<?php 
								$sqlbaneados = $db->query("SELECT * FROM bans ORDER BY id DESC");
								while($b = $sqlbaneados->fetch_assoc()) {
								?>
								<tr>
								    <td><?php echo $b['value']; ?></td>
								    <td><?php echo $b['reason']; ?></td>
								    <td><?php echo $b['added_by']; ?></td>
								    <td><?php echo date('d/m/Y', $b['added_date']); ?></td>
								    <td><?php echo $totix->fecha_dat($b['expire']); ?></td>
								    <td>
									    <button class="btn btn-info" data-toggle="modal" data-target="#<?php echo $b['id']; ?>">
										      <span class="glyphicon glyphicon-wrench"></span> Ajustes
										 </button>
										
										<div class="modal fade bs-example-modal-lg" id="<?php echo $b['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
												    <form action="submits/submit_bans.php" method="POST">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Baneo de <b><?php echo $b['value']; ?></b></h4>
                                                        </div>
                                                        <div class="modal-body">
													        <label for="ban_time_m">Agregar más tiempo</label>
						                                    <div class="form-group">
							                                    <div class="col-lg-6">
                                                                    <input type="text" class="form-control" id="ban_time_m" name="ban_time_m" placeholder="¿Cuánto tiempo más? (digítos)">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <select name="ban_format_m" class="form-control">
							                                		    <option value="horas">Hora(s)</option>
							                                		    <option value="dias">Día(s)</option>
							                                			<option value="meses">Mes(es)</option>
							                                			<option value="anios">Año(s)</option>
							                                		</select>
                                                                </div>
                                                            </div>
							                                <div class="form-group">
                                                                <label for="ban_reason_m">Cambiar razón</label>
                                                                <textarea class="form-control" name="ban_reason_m" id="ban_reason_m" rows="3"><?php echo $b['reason']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
								                            <div class="btn-group">
											                    <button type="submit" name="ban_del" value="<?php echo $b['id']; ?>" class="btn btn-danger">
											                        <span class="glyphicon glyphicon-remove"></span> Borrar ban
											                    </button>
										                    </div>									            
                                                            <button type="submit" name="ban_submit_m" value="<?php echo $b['id']; ?>" class="btn btn-primary">Guardar cambios</button>													
                                                        </div>
													</form>
                                                </div>
                                            </div>
                                        </div>									
									</td>
								</tr>
								<?php } ?> 
							</table>
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
<?php if(isset($_SESSION['ban_error']) || isset($_SESSION['ban_resultado'])) { unset($_SESSION['ban_error']); unset($_SESSION['ban_resultado']); } ?>