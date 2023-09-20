<div id="avisos"></div>
<?php
$actividadusuario = $db->query($queryact);
$actividades = $actividadusuario->num_rows;
if($actividades == 0)
{
	echo '<div class="alert alert-info">Este usuario no ha hecho nada interesante en estos tiempos...</div>';
}

while($actu = $actividadusuario->fetch_assoc()) {
	if($actu['type'] == 'portada')
	{
		unset($descripcion);
		$descripcion = 'ha cambiado su <a data-fancybox="gallery" href="'.$actu['portadalink'].'" title="Portada de '.$perfil['username'].'">portada</a>';
	}
	elseif($actu['type'] == 'articulo')
	{
		unset($descripcion);
		$descripcion = 'ha publicado un nuevo articulo';
	}
	elseif($actu['type'] == 'aviso')
	{
		unset($descripcion);
		$descripcion = 'ha publicado un estado';
	}
	
	if(isset($pageme) && !empty($pageme))
	{
	    $elusuario = $db->query("SELECT id, username, look, online, rank FROM users WHERE id = '". $actu['userid'] ."'");
	    $perfil = $elusuario->fetch_assoc();
	}
?>
<?php if($actu['type'] == 'portada' && !isset($pageme) && empty($pageme)) { ?>
<div class="panel panel-primary">
	<div class="panel-body">
        <div class="foto_usuario" style="background: url(<?php echo avatar . $perfil['look']; ?>&direction=3&head_direction=3&size=b&gesture=agr); background-position: -13px -20px; background-color: #e6c873;"></div>
        <h6 style="margin-top: 4px;">
			<a href="/home/<?php echo $perfil['username']; ?>"><?php echo $perfil['username'] . $totix->verificado($perfil['rank']); ?></a><span class="text-muted"> - <?php echo $descripcion; ?></span>
			<br />
			<span class="text-muted"><?php echo $totix->getlast($actu['timestamp']); ?></span>
		</h6>
		<?php if($totix->user('id') == $actu['userid']) { ?>
		<form style="float: right; margin-top: -45px;" action="<?php echo www; ?>/app/submits/aviso_submit.php" method="POST">
			<button type="submit" name="delete" class="btn btn-danger" value="<?php echo $actu['id']; ?>">
                <span class="glyphicon glyphicon-remove"></span> Eliminar publicación
            </button>
			<input type="hidden" name="location" value="<?php echo $pagina; ?>" />
		</form>
		<?php } ?>
	</div>
</div>
<div class="actividad-imagenes" style="background-image: url('<?php echo $actu['portadalink'] . '?' . rand(0,999999); ?>'); background-position: center; background-size: 100%;"></div>
<?php 
} elseif($actu['type'] == 'articulo') { 
$agarramelaverga = $db->query("SELECT id, title, image, shortstory, date FROM cms_news WHERE date = '" . $actu['articuloid'] . "'");
$keriko = $agarramelaverga->fetch_assoc();
?>
<div class="panel panel-primary">
	<div class="panel-body">
        <div class="foto_usuario" style="background: url(<?php echo avatar . $perfil['look']; ?>&direction=3&head_direction=3&size=b&gesture=agr); background-position: -13px -20px; background-color: #e6c873;"></div>
        <h6 style="margin-top: 4px;">
			<a href="/home/<?php echo $perfil['username']; ?>"><?php echo $perfil['username'] . $totix->verificado($perfil['rank']); ?></a><span class="text-muted"> - <?php echo $descripcion; ?></span>
			<br />
			<span class="text-muted"><?php echo $totix->getlast($actu['timestamp']); ?></span>
		</h6>
	</div>
</div>
<div class="actividad-imagenes" style="background-image: url('<?php echo $keriko['image'] . '?' . rand(0,999999); ?>'); background-position: center; background-size: 100%;">
	<h3 class="actividad-imagen-texto"><?php echo $keriko['title']; ?></h3>
	<p class="actividad-imagen-parrafo"><?php echo $keriko['shortstory']; ?></p>
	<a class="btn btn-success" href="<?php echo www; ?>/news/<?php echo $keriko['id']; ?>" style="float: right; margin-top: 160px; margin-right: 20px;">Leer más &raquo;</a>
</div>
<?php } elseif($actu['type'] == 'aviso') { ?>
<div class="panel panel-primary">
	<div class="panel-body">
        <div class="foto_usuario" style="background: url(<?php echo avatar . $perfil['look']; ?>&direction=3&head_direction=3&size=b&gesture=agr); background-position: -13px -20px; background-color: #e6c873;"></div>
        <h6 style="margin-top: 4px;">
			<a href="/home/<?php echo $perfil['username']; ?>"><?php echo $perfil['username'] . $totix->verificado($perfil['rank']); ?></a><span class="text-muted"> - <?php echo $descripcion; ?></span>
			<br />
			<span class="text-muted"><?php echo $totix->getlast($actu['timestamp']); ?></span>
		</h6>
		<?php if($totix->user('id') == $actu['userid']) { ?>
		<form style="float: right; margin-top: -45px;" action="<?php echo www; ?>/app/submits/aviso_submit.php" method="POST">
			<button type="submit" name="delete" class="btn btn-danger" value="<?php echo $actu['id']; ?>">
                <span class="glyphicon glyphicon-remove"></span> Eliminar publicación
            </button>
			<input type="hidden" name="location" value="<?php echo $pagina; ?>" />
		</form>
		<?php } ?>
		<hr />
		<?php echo $actu['contenido']; ?>
	</div>
</div>
<?php } } ?>