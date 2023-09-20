<?php
if($ajuste == 'personales')
{
    $active_p = 'active';
}
elseif($ajuste == 'correo')
{
	$active_c = 'active';
}
elseif($ajuste == 'pass')
{
	$active_pa = 'active';
}
?>
<div class="list-group">
  <a href="<?php echo www; ?>/settings/personales" class="list-group-item <?php echo $active_p; ?>">Personales &raquo;</a>
  <a href="<?php echo www; ?>/settings/correo" class="list-group-item <?php echo $active_c; ?>">Cambiar correo &raquo;</a>
  <a href="<?php echo www; ?>/settings/pass" class="list-group-item <?php echo $active_pa; ?>">Cambiar contraseña &raquo;</a>
</div>