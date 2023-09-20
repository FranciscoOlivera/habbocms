<div class="col-sm-3 col-md-2 sidebar">
	<ul class="list-group">
        <li class="list-group-item active"><center><img class="avatar img-circle" src="<?php echo avatar . $totix->user('look'); ?>&size=l&gesture=sml&head_direction=3&headonly=1" /></center></li>
        <li class="list-group-item">Hola <b><?php echo $totix->user('username'); ?></b></li>
		<li class="list-group-item"><b><?php echo $totix->user('motto'); ?></b></li>
	</ul>
    <ul class="nav nav-sidebar">
        <li><a href="<?php echo www . panel; ?>/inicio.php"><span class="glyphicon glyphicon-tower"></span> Interfaz</a></li>
        <li><a href="<?php echo www . panel; ?>/news.php"><span class="glyphicon glyphicon-list-alt"></span> Noticias</a></li>
        <li><a href="<?php echo www . panel; ?>/bans.php"><span class="glyphicon glyphicon-exclamation-sign"></span> Baneos</a></li>
        <?php if($totix->user('rank') >= hkmax) { ?><li><a href="<?php echo www . panel; ?>/users.php"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li><?php } ?>
		<?php if($totix->user('rank') >= hkmax) { ?><li><a href="<?php echo www . panel; ?>/ranks.php"><span class="glyphicon glyphicon-certificate"></span> Gestor de rangos</a></li><?php } ?>
		<li><a href="#"><span class="glyphicon glyphicon-asterisk"></span> Placas</a></li>
		<li><a href="#"><span class="glyphicon glyphicon-globe"></span> Salas</a></li>
    </ul>
</div>