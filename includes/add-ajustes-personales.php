<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Ajustes personales</h3>
    </div>
	<div class="panel-body">
	    <form action="<?php echo www; ?>/app/submits/settings_submit.php" method="POST">
	        <div class="input-group">
                <input type="text" name="ch_motto" class="form-control" value="<?php echo $totix->user('motto'); ?>" />
                <span class="input-group-btn">
                    <button type="submit" name="ch_motto_submit" class="btn btn-success">Cambiar misión</button>
                </span>
            </div>
		</form>
		<span class="help-block">Aquí podras cambiar tú misión, esta misión pueden verla todos los usuarios de <b><?php echo name; ?></b></span>
		<hr />
	    <form action="<?php echo www; ?>/app/submits/settings_submit.php" method="POST">
	        <div class="input-group">
                <input type="text" name="ch_fb" class="form-control" placeholder="Link de tu facebook personal" />
                <span class="input-group-btn">
                    <button type="submit" name="ch_fb_submit" class="btn btn-primary">Actualizar</button>
                </span>
            </div>
		</form>
		<span class="help-block">Aquí puedes poner tu facebook personal copiando el link completo, ej: <code>http://www.facebook.com/TotixHolos</code> <b>dejalo en blanco para quitar tu facebook</b></span>
		<hr />
		    <?php
			if($totix->user('block_newfriends') == '0') {
				$color_s = 'danger';
				$valor_s = 'Desactivar solicitudes';
			} else {
				$color_s = 'success';
				$valor_s = 'Activar solicitudes';
			}
			if($totix->user('hide_online') == '0') {
				$color_o = 'danger';
				$valor_o = 'Desactivar "En línea"';
			} else {
				$color_o = 'success';
				$valor_o = 'Activar "En línea"';
			}
			if($totix->user('hide_inroom') == '0') {
				$color_r = 'danger';
				$valor_r = 'Desactivar "Sigueme"';
			} else {
				$color_r = 'success';
				$valor_r = 'Activar "Sigueme"';
			}
			if($totix->user('ignore_invites') == '0') {
				$color_i = 'danger';
				$valor_i = 'Desactivar invitaciones';
			} else {
				$color_i = 'success';
				$valor_i = 'Activar invitaciones';
			}
			?>
		<form action="<?php echo www; ?>/app/submits/settings_submit.php" method="POST">
		    <div class="btn-group">
                <button type="submit" name="ch_btn_sa" class="btn btn-<?php echo $color_s; ?>"><?php echo $valor_s; ?></button>
		    	<button type="submit" name="ch_btn_el" class="btn btn-<?php echo $color_o; ?>"><?php echo $valor_o; ?></button>
			    <button type="submit" name="ch_btn_si" class="btn btn-<?php echo $color_r; ?>"><?php echo $valor_r; ?></button>
			    <button type="submit" name="ch_btn_in" class="btn btn-<?php echo $color_i; ?>"><?php echo $valor_i; ?></button>
			</div>
		</form>
    </div>
</div>	