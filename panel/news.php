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

$id_n = $totix->filtro($_GET['n']);
$action = $totix->filtro($_GET['action']);

if(!empty($id_n) && isset($id_n))
{
	$sql_new = $db->query("SELECT * FROM cms_news WHERE id = '". $id_n ."' LIMIT 1");
	if($sql_new->num_rows > 0)
	{
		$n = $sql_new->fetch_assoc();
	}
	else
	{
		$error = 'La noticia que solicitas, no existe';
	}
}
else
{
	$error = 'Selecciona una noticia para editar';
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="<?php echo www . panel; ?>/assets/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/bootstrap.min.css?sdf" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/non-responsive.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo www . panel; ?>/bootstrap/css/style.css?Asas" />
		<script> 
        function abrir(url) { 
        open(url,'','top=100,left=300,width=780,height=600') ; 
        } 
		
        function pregunta(e){ 
            if(confirm('¿Estas seguro que quieres borrar esta noticia?')){ 
            document.delete.submit() 
            } 
			else{
                e.preventDefault();
            }
        } 
        </script>
		

        <title><?php echo name; ?> &raquo; Panel de administración</title>

    </head>
<body>

    <?php include_once 'includes/nav.php'; ?>

    <div class="container-fluid">
      <div class="row">
	  
        <?php include_once 'includes/sidebar.php'; ?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		     <?php if(isset($_SESSION['new_error'])) { echo '<div class="alert alert-danger">' . $_SESSION['new_error'] .'</div>'; } elseif(isset($_SESSION['new_resultado'])) { echo '<div class="alert alert-success">' . $_SESSION['new_resultado'] .'</div>'; } ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Administrador de las noticias</h3>
                </div>
	            <div class="panel-body">
				<a href="<?php echo www . panel; ?>/news.php?action=new" class="btn btn-success btn-block">¡Crear nueva noticia!</a>
				<br /><br />
				    <div class="col-xs-4">
					  <div class="well well-sm">
                        <table class="table table-striped">
                            <?php
						    $sqlnews = $db->query("SELECT * FROM cms_news ORDER BY id DESC");
                            while($new = $sqlnews->fetch_array()) {
						    ?>
						    <tr>
						        <td>
								    <form name="delete" action="<?php echo www . panel; ?>/submits/submit_news.php" method="POST">
							            <div class="btn-group option-news">
									        <a href="<?php echo www; ?>/news/<?php echo $new['id']; ?>" target="_blank" class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span></a>
                                            <a href="<?php echo www . panel; ?>/news.php?action=modify&n=<?php echo $new['id']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-wrench"></span></a>
								     	    <button onclick="pregunta(event)" name="submit_del" value="<?php echo $new['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                        </div>
									</form>
							        <p><?php echo $new['title']; ?> <b>(<?php echo $new['author']; ?>)</b></p>
							    	<small>Creada el día <b><?php echo date("d/m/Y", $new['date']); ?></b></small>
							    </td>
						    </tr>
						    <?php } ?>
                        </table>
					  </div>
					</div>
					<div class="col-xs-8">
					    <div class="well well-sm">
						<?php
						if($action == 'new') {
						?>
						<div class="alert alert-info"><b><span class="glyphicon glyphicon-bullhorn"></span> Atención:</b> Estas <b>CREANDO</b> una noticia</div>
						<form action="<?php echo www . panel; ?>/submits/submit_news.php" method="POST">
                            <div class="form-group">
                                <label for="titlec">Titulo</label>
                                <input type="text" class="form-control" id="titlec" name="titlec" placeholder="Ej: ¡Bienvenidos al hotel!" required>
                            </div>
							<div class="form-group">
                                <label for="shortstoryc">Introducción</label>
                                <input type="text" class="form-control" id="shortstoryc" name="shortstoryc" placeholder="Ej: Un hotel en el que podras hacer miles de cosas" required>
                            </div>
							<label for="longstoryc">Cuerpo</label>
						    <textarea name="longstoryc" id="longstoryc" rows="10" cols="80"></textarea>
                            <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'longstoryc' );
                            </script>
							<br />
							<div class="input-group">
                                <span class="input-group-btn">
                                    <a href="javascript:abrir('promos.php')" class="btn btn-info">Ver galeria</a>
                                </span>
                                <input type="text" name="imagec" class="form-control" placeholder="URL de imagen" required>
                            </div>
							<hr />
							<button type="submit" name="submit_c" class="btn btn-primary btn-block">Crear noticia</button>
						</form>
					    <?php 
						} elseif($action == 'modify' && isset($n)) {
						?>
						<div class="alert alert-info"><b><span class="glyphicon glyphicon-bullhorn"></span> Atención:</b> Estas <b>MODIFICANDO</b> una noticia</div>
						<form action="<?php echo www . panel; ?>/submits/submit_news.php" method="POST">
                            <div class="form-group">
                                <label for="titlem">Titulo</label>
                                <input type="text" class="form-control" id="titlem" name="titlem" value="<?php echo $n['title']; ?>" required>
                            </div>
							<div class="form-group">
                                <label for="shortstorym">Introducción</label>
                                <input type="text" class="form-control" id="shortstorym" name="shortstorym" value="<?php echo $n['shortstory']; ?>" required>
                            </div>
							<label for="longstorym">Cuerpo</label>
						    <textarea name="longstorym" id="longstorym" rows="10" cols="80"><?php echo $n['longstory']; ?></textarea>
                            <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'longstorym' );
                            </script>
							<br />
							<div class="input-group">
                                <span class="input-group-btn">
                                    <a href="javascript:abrir('promos.php')" class="btn btn-info">Ver galeria</a>
                                </span>
                                <input type="text" name="imagem" class="form-control" value="<?php echo $n['image']; ?>" required>
                            </div>
							<input type="hidden" name="idm" value="<?php echo $n['id']; ?>" />
							<hr />
							<button type="submit" name="submit_m" class="btn btn-primary btn-block">Guardar cambios</button>
						</form>
						<?php
						} else {
							echo '<i>'.$error.'</i>'; 
						}
						?>
						</div>
					</div>
                </div>
            </div>
	    </div>
      </div>	
	</div>

<script src="<?php echo www; ?>/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php if(isset($_SESSION['new_error']) || isset($_SESSION['new_resultado'])) { unset($_SESSION['new_error']); unset($_SESSION['new_resultado']); } ?>