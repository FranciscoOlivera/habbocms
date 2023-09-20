<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Ajustes de contraseña</h3>
    </div>
	<div class="panel-body">
	  <form action="<?php echo www; ?>/app/submits/settings_submit.php" method="POST">
	    <p>Esta herramienta sirve para cambiar tu contraseña en caso de que alguien más la tenga o te sientas inseguro, usala con cuidado</p>
	    <div class="form-group">
            <input type="password" name="ch_pass" class="form-control" placeholder="Contraseña actual">
        </div>
        <div class="form-group">
            <input type="password" name="ch_npass" class="form-control" placeholder="Nueva contraseña">
        </div>
		<div class="form-group">
            <input type="password" name="ch_rnpass" class="form-control" placeholder="Repite contraseña nueva (por seguridad)">
        </div>
		<button type="submit" name="ch_pass_btn" class="btn btn-success btn-block">Cambiar contraseña</button>
	  </form>	
	</div>
</div>	