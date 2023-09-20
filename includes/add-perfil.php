<?php

if($perfil['online'] !== null)
{
	$color = '#AB0D0D';
} else {
	$color = '#4caf50';
}

?>
<div class="panel panel-default" style="background: url('<?php echo $perfil['portada'] . '?' . rand(0,999999); ?>'); background-position: center; background-size: 100%; height: 240px;">
	<div class="panel-body">
	    <div class="col-xs-2">
	        <div style="background: url(<?php echo avatar . $perfil['look']; ?>&direction=3&head_direction=3&action=std&size=l&gesture=std) no-repeat, url(<?php echo www; ?>/app/images/foto.png); border: 3px solid #fff; border-radius: 5px; box-shadow: 0 1px 1px rgba(0, 0, 0, .4); width: 138px; height: 138px; position:absolute;  top: 155px; left:25px; background-position: center -33px, center right;"></div>
			<h5 class="inline-block" style="bottom: 57px; position: relative; color: #fff; font-size: 23px; padding: 17px; width: 508px; left: 160px; top: 150px;"><?php echo $perfil['username'] . $totix->verificado($perfil['rank']); ?></h5>
		</div>
		<?php
		if(empty($perfil['fb']))
		{
			$fb = 'http://fb.com/TotixHolos';
		}
		else
		{
			$fb = $perfil['fb'];
		}
		?>
		<div class="clearfix">
			<form action="<?php echo www; ?>/app/submits/portada_submit.php" method="POST" enctype="multipart/form-data">
		        <div class="btn-group float-right botonesperfil">
                    <a href="<?php echo $fb; ?>" target="_blank" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-share"></span> Facebook</a>
				    <?php if($perfil['id'] == $totix->user('id')) { ?>
                    <div class="fileUpload btn btn-danger">
                            <span><span class="glyphicon glyphicon-upload"></span> Subir portada</span>
                            <input type="file" name="portada" accept="image/jpg,image/jpeg,image/png" onchange="this.form.submit()" class="upload" />
                    </div>
				    <a href="<?php echo www; ?>/settings" type="button" class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span> Ajustes</a>
				    <?php } else { echo ''; } ?>
                </div>
			</form>
		</div>
	</div>
</div>	

<div class="panel panel-default">
  <div class="panel-body">
    <div class="right-perfil">
        <button class="btn btn-warning"><?php echo $perfil['motto']; ?></button>
		<button class="btn btn-primary"><b>Amigos: <?php echo $totix->contar('amigos', $perfil['id']); ?></b></button>
		<button class="btn btn-primary"><b>Fotos: <?php echo $totix->contar('fotos', $perfil['id']); ?></b></button>
		<button class="btn btn-primary"><b>Salas: <?php echo $totix->contar('salas', $perfil['id']); ?></b></button>
        <div class="on-perfil" style="background: <?php echo $color; ?>"></div>
    </div>
  </div>
</div>