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
$totix->checkrank('maxrank');

if(!isset($_SESSION['hk_loged'])) 
{ 
    header("Location: ".www . panel .""); 
}

$id = $totix->filtro($_GET['id']);

if(!empty($id) && isset($id))
{
	$sql_perfil = $db->query("SELECT * FROM users WHERE id = '". $id ."' LIMIT 1");
	if($sql_perfil->num_rows > 0)
	{
		$perfil = $sql_perfil->fetch_assoc();
	}
	else
	{
		$error = 'El perfil que solicitas no existe';
	}
}
else
{
	$error = 'Elige un usuario y aparecera aquí...';
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
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/style.css?s" />

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
                    <h3 class="panel-title">Administración de usuarios</h3>
                </div>
	            <div class="panel-body">
                    <div class="col-xs-4">
					    <div class="well well-sm">
						    <div class="alert alert-danger"><b><span class="glyphicon glyphicon-bullhorn"></span> Atención:</b> Si sale más de un usuario, es porque tiene multi cuenta.</div>
						    <form name="buscar" action="" method="get">
                                <div class="input-group">
                                    <input type="text" name="frase" class="form-control" value="<?php echo $_GET['frase']; ?>" placeholder="Introduce un nombre de usuario">
                                    <span class="input-group-btn">
                                       <button class="btn btn-success" type="submit" name="buscar" value="Buscar">Buscar</button>
                                    </span>
                                </div>
                            </form>
						    <?php
if(isset($_GET['buscar']) && $_GET['buscar'] == 'Buscar'){
    $frase = $totix->filtro($_GET['frase']);

    $sqlBuscar = $db->query("SELECT id, username, mail, look, ip_last, ip_reg
                            FROM users WHERE username = '".$frase."'
                            ORDER BY id DESC LIMIT 1")
                            or die($db->error);
    $totalRows = $sqlBuscar->num_rows;

    if(!empty($totalRows)){
        echo stripslashes("<br /><p><center><h2>Resultados</h2></center></p>");
		$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Crea', 'Busco al usuario $frase.', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");

        while($row = $sqlBuscar->fetch_array()){
		    $ipusers = $db->query("SELECT * FROM users WHERE ip_reg = '". $row['ip_reg'] ."'");
            while($users = $ipusers->fetch_assoc()) {		
?>	  
            <img src="<?php echo avatar . $users['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /><a href="<?php echo www . panel; ?>/users.php?id=<?php echo $users['id']; ?>"><?php echo $users['username']; ?></a>
			<font style="float: right;">
			    <b>IP de registro:</b> <a href="http://whois.domaintools.com/<?php echo $row['ip_reg']; ?>" target="_blank"><?php echo $row['ip_reg']; ?></a>
				<br />
			    <b>IP de cliente:</b> <a href="http://whois.domaintools.com/<?php echo $row['ip_last']; ?>" target="_blank"><?php echo $row['ip_last']; ?></a>
			</font>
            <hr />
			
          <?php
            }
        }
    }
    elseif(empty($_GET['frase'])){
        echo "<br /><center>Debe introducir una palabra o frase.</center>";
    }
    elseif($totalRows == 0){
        echo stripslashes("<br /><center>Su busqueda no encontro resultados para <strong>$frase</strong></center>");
    }
}
?>
						</div>
					</div>
					<div class="col-xs-8">
					    <div class="well well-sm">
					        <i>
								<?php echo $error; ?>
							</i>
							<h2><?php echo $perfil['username']; ?></h2>
					    </div>
					    <div class="well well-sm">
						    <h2>Usuarios conectados (ordenados alfabeticamente)</h2>
							<hr />
							<div class="scroll">
							<table class="table table-bordered">
							    <tr>
								    <td>
									    <b>Nombre del usuario</b>
									</td>
									<td>
									    <b>IP de cliente</b>
									</td>
									<td>
									    <b>Acción</b>
									</td>									
								</tr>
								<?php
								$sql_userss = $db->query("SELECT * FROM users WHERE online = '1' ORDER BY username ASC");
								while($usuario = $sql_userss->fetch_assoc()) {
								?>
								<tr>
								    <td>
									    <img src="<?php echo avatar . $usuario['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /><a href="<?php echo www . panel; ?>/users.php?id=<?php echo $usuario['id']; ?>"><?php echo $usuario['username']; ?></a>
									</td>
									<td>
									    <a href="http://whois.domaintools.com/<?php echo $usuario['ip_last']; ?>" target="_blank"><?php echo $usuario['ip_last']; ?></a>
									</td>
									<td>
									    <a href="<?php echo www . panel; ?>/rooms.php?owner=<?php echo $usuario['id']; ?>">Ver salas</a>
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
	</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js?asd"></script>
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php if(isset($_SESSION['ban_error']) || isset($_SESSION['ban_resultado'])) { unset($_SESSION['ban_error']); unset($_SESSION['ban_resultado']); } ?>