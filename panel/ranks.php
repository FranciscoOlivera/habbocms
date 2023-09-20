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

$getrank = $db->query("SELECT * FROM ranks ORDER BY id ASC");

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
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/style.css?asd" />

        <title><?php echo name; ?> &raquo; Panel de administración</title>

    </head>
<body>

    <?php include_once 'includes/nav.php'; ?>

    <div class="container-fluid">
      <div class="row">
	  
        <?php include_once 'includes/sidebar.php'; ?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		   	<?php if(isset($_SESSION['rank_error'])) { echo '<div class="alert alert-danger">' . $_SESSION['rank_error'] .'</div>'; } elseif(isset($_SESSION['rank_ok'])) { echo '<div class="alert alert-success">' . $_SESSION['rank_ok'] .'</div>'; } ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Gestor de rangos administrativos</h3>
                </div>
	            <div class="panel-body">
				    <div class="col-xs-12">
                        <div class="well well-sm">
					        <h2>Herramienta para dar/quitar rango</h2>
						    <hr />
						    <form action="<?php echo www . panel; ?>/submits/submit_ranks.php" method="POST">
						        <div class="form-group">
							        <div class="col-lg-4">
                                        <input type="text" class="form-control" id="user_rank" name="user_rank" placeholder="Nombre del usuario...">
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="rank_rank" class="form-control">
								    	    <?php while($rangos = $getrank->fetch_assoc()) { ?>
		                                    <option value="<?php echo $rangos['id']; ?>"><?php echo $rangos['name']; ?></option>
		                                    <?php } ?>
								    	</select>
                                    </div>
								    <div class="col-lg-4">
                                        <button type="submit" name="rank_submit" class="btn btn-success btn-block">¡Dar/quitar rango!</button>
                                    </div>
                                </div>
						    </form>
						    .
					    </div>
					</div>
					
					<div class="col-xs-4">
					    <div class="well well-sm">
						    <h2>Rangos</h2>
						    <table class="table table-striped">
                            <?php
						    $sqlrangos = $db->query("SELECT * FROM ranks ORDER BY id DESC");
                            while($_rangos = $sqlrangos->fetch_array()) {
						    ?>
						    <tr>
						        <td>
								    <form action="<?php echo www . panel; ?>/submits/submit_ranks.php" method="POST">
							            <div class="btn-group option-news">
                                            <a href="<?php echo www . panel; ?>/ranks.php?action=modify&id=<?php echo $_rangos['id']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-wrench"></span></a>
								     	    <button type="submit" name="submit_del" value="<?php echo $_rangos['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                        </div>
									</form>
							        <p><b><?php echo $_rangos['name']; ?></b> (<?php echo $_rangos['title']; ?>)</p>
							    </td>
						    </tr>
						    <?php } ?>
                        </table>
						</div>
					</div>
					<div class="col-xs-8">
						<?php
						$sql_rangos = $db->query("SELECT * FROM ranks WHERE id >= '".minrank."' ORDER BY id DESC");
						while($rango = $sql_rangos->fetch_assoc()) {
						?>
						    <div class="well well-sm">
						        <h3><?php echo $rango['name']; ?></h3>
								<table class="table table-bordered">
								    <tr>
						            <?php
                                    $users = $db->query("SELECT * FROM users WHERE rank = '". $rango['id'] ."'");
                                    if($users->num_rows == 0) { 
                                        echo '<b>No hay '. $rango['name'] .' aún.</b>'; 
                                    }
                                    while($staffs = $users->fetch_assoc())
                                    {
                                    ?>					        
								        <td><img src="<?php echo avatar . $staffs['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /><a href="<?php echo www . panel; ?>/users.php?id=<?php echo $staffs['id']; ?>"><?php echo $staffs['username']; ?></a></td>					            
								    <?php } ?>
								    </tr>
								</table>
						    </div>
						<?php } ?>
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
<?php if(isset($_SESSION['rank_error']) || isset($_SESSION['rank_ok'])) { unset($_SESSION['rank_error']); unset($_SESSION['rank_ok']); } ?>