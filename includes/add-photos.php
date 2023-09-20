<?php	
$fotos = $db->query("SELECT * FROM server_pictures_publish ORDER BY id DESC");
while($f = $fotos->fetch_assoc())
{
	$datosfoto = $db->query("SELECT * FROM server_pictures WHERE id = '" . $f['picture_id'] . "'");
	$datos = $datosfoto->fetch_assoc();
	
	$usuariofoto = $db->query("SELECT id, username, look, rank FROM users WHERE id = '" . $datos['user_id'] . "'");
	$usuario = $usuariofoto->fetch_assoc();
?>
        <div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
			    <div class="panel-body">
                    
					<a data-fancybox="gallery" href="<?php echo www; ?>/camera/pictures/<?php echo $f['picture_id']; ?>.png" title="Foto de <?php echo $usuario['username']; ?>">
					    <img src="<?php echo www; ?>/camera/pictures/<?php echo $f['picture_id']; ?>.png" class="img-thumbnail photos">
					</a>
					
					<div class="foto_usuario" style="background: url(<?php echo avatar . $usuario['look']; ?>&direction=3&head_direction=3&size=b&gesture=agr); background-position: -13px -20px; background-color: #e6c873;"></div>
					
					<h5 class="foto_nombre">
					    <a href="/home/<?php echo $usuario['username']; ?>">
						    <?php echo $usuario['username'] . $totix->verificado($usuario['rank']); ?>
						</a>
					</h5>
		        </div>
			</div>
        </div>
		
<?php } ?>