<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Ajustes de correo</h3>
    </div>
	<div class="panel-body">
	  <form action="<?php echo www; ?>/app/submits/settings_submit.php" method="POST">
	    <p>Si quieres cambiar tu correo electronico esta es la herramienta que necesitas: pon tu correo electronico actual, pon uno nuevo, repitelo y guarda cambios, <b>por seguridad</b> tendras que poner tu contraseña si quieres que los cambios se realicen.</p>
	    <div class="form-group">
            <input type="email" name="ch_mail" class="form-control" placeholder="Correo electronico actual">
        </div>
        <div class="form-group">
            <input type="email" name="ch_nmail" class="form-control" placeholder="Nuevo correo electronico">
        </div>
		<div class="form-group">
            <input type="password" name="check_password_mail" class="form-control" placeholder="Contraseña">
        </div>
		<button type="submit" name="ch_mail_btn" class="btn btn-success btn-block">Cambiar correo electronico</button>
	  </form>	
	</div>
</div>	