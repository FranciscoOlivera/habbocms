<div class="panel panel-success">
    <div class="panel-heading">
	    <h3 class="panel-title"><span class="icono azul glyphicon glyphicon-camera"></span> Fotos de <?php echo $perfil['username']; ?></h3>
    </div>
	<div class="panel-body">
	    <div class="scroll">
<?php	
    $fotoss = $db->query("SELECT * FROM server_pictures_publish WHERE user_id = '" . $perfil['id'] . "' ORDER BY id DESC");	
	if($fotoss->num_rows == 0)
	{
		echo '<b>Este usuario aún no ha hecho ninguna foto...</b>';
	}
	
    while($fotoo = $fotoss->fetch_assoc())
    {
?>

<a data-fancybox="gallery" href="<?php echo www; ?>/camera/pictures/<?php echo $fotoo['picture_id']; ?>.png" title="Foto de <?php echo $perfil['username']; ?>">
	<img src="<?php echo www; ?>/camera/pictures/<?php echo $fotoo['picture_id']; ?>.png" class="img-thumbnail fotitos">
</a>

<?php 
    }	
?>	    
        </div>
	</div>
</div>