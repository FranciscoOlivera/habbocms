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

$cat = $totix->filtro($_GET['cat']);
$subcat = $totix->filtro($_GET['subcat']);
$furni = $totix->filtro($_GET['furni']);
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
                    <h3 class="panel-title">Catalogo del hotel</h3>
                </div>
	            <div class="panel-body">
                    <div class="col-xs-2">
						<div class="list-group">
							<?php
							$sql_lista = $db->query("SELECT id, parent_id, caption FROM catalog_pages WHERE parent_id = '-1' ORDER BY id ASC");
							while($lista = $sql_lista->fetch_assoc()) {
							?>
								<a href="?cat=<?php echo $lista['caption']; ?>" class="list-group-item"><?php echo $lista['caption']; ?></a></li>
							<?php } ?>
						</div>
					</div>
					<?php if(isset($cat) && !empty($cat)) { ?>
					<div class="col-xs-2">
						    <h2><?php echo $cat; ?></h2>
							<div class="list-group">
								<?php
								$sql_cats = $db->query("SELECT id, parent_id, caption FROM catalog_pages WHERE caption = '".$cat."' LIMIT 1");
								$sql_cats_id = $sql_cats->fetch_assoc();
								$sql_subcat = $db->query("SELECT id, parent_id, caption, visible FROM catalog_pages WHERE parent_id = '".$sql_cats_id['id']."' ORDER BY caption ASC");
								while($listasub = $sql_subcat->fetch_assoc()) {
									
									$furnito = $db->query("SELECT id, parent_id, caption, visible FROM catalog_pages WHERE parent_id = '".$listasub['id']."'");
									if($furnito->num_rows == 0)
									{
										$id = $listasub['id'];
										$listasub['id'] = $id . '&furni=' . $id;
									}
								?>
									<a href="?cat=<?php echo $cat; ?>&subcat=<?php echo $listasub['id']; ?>" class="list-group-item"><?php echo $listasub['caption']; ?><?php if($listasub['visible'] == '1') { echo ''; } else { echo ' - (Oculto)'; } ?></a></li>
								<?php } ?>
							</div>
					</div>
					<?php }
					if(isset($cat) && !empty($cat) && isset($subcat) && !empty($subcat)) { 
					$sql_subcats = $db->query("SELECT id, parent_id, caption FROM catalog_pages WHERE id = '".$subcat."' LIMIT 1");
					$sql_subcats_id = $sql_subcats->fetch_assoc();					
					?>
					<div class="col-xs-2">
						    <h2><?php echo $sql_subcats_id['caption']; ?></h2>
							<div class="list-group">
								<?php
								$sql_subsubcat = $db->query("SELECT id, parent_id, caption, visible FROM catalog_pages WHERE parent_id = '".$sql_subcats_id['id']."' ORDER BY caption ASC");
								while($listasubsub = $sql_subsubcat->fetch_assoc()) {
								?>
									<a href="?cat=<?php echo $cat; ?>&subcat=<?php echo $subcat; ?>&furni=<?php echo $listasubsub['id']; ?>" class="list-group-item"><?php echo $listasubsub['caption']; ?><?php if($listasubsub['visible'] == '1') { echo ''; } else { echo ' - (Oculto)'; } ?></a></li>
								<?php } ?>
							</div>
					</div>
					<?php }
					if(isset($cat) && !empty($cat) && isset($subcat) && !empty($subcat) && isset($furni) && !empty($furni)) { 
                    $sql_view = $db->query("SELECT id, parent_id, caption FROM catalog_pages WHERE id = '".$furni."' LIMIT 1");
					$sql_view_id = $sql_view->fetch_assoc();	
                    $sql_furni = $db->query("SELECT * FROM catalog_items WHERE page_id = '".$furni."' ORDER BY catalog_name ASC");				
					?>
					<div class="col-xs-6">
						<div class="well well-sm">
						<h2><?php echo $sql_view_id['caption']; ?></h2>
							<table class="table table-bordered">
								<tr>
									<td>Nombre furni</td><td>ID</td><td>Costo</td><td>Cantidad</td><td>Limite</td><td>Placa</td>
								</tr>
								<?php while($f = $sql_furni->fetch_assoc()) { ?>
								<tr>
									<td>
										<?php echo $f['catalog_name']; ?>
									</td>
									<td>
										<?php echo $f['item_id']; ?>
									</td>
									<td>
										<img src="<?php echo www; ?>/app/images/icons/coins.png" /> <?php echo $f['cost_credits']; ?> <br />
										<img src="<?php echo www; ?>/app/images/icons/duckets.png" /> <?php echo $f['cost_pixels']; ?> <br />
										<img src="<?php echo www; ?>/app/images/icons/diamond.png" /> <?php echo $f['cost_diamonds']; ?> <br />
									</td>
									<td>
										Cantidad
									</td>
									<td>
										Limite
									</td>
									<td>
										Placa
									</td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					<?php } else { echo 'Eligue una categoria'; } ?>
                </div>
            </div>
	    </div>
      </div>	
	</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>