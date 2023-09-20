<div class="header">
    <div class="cuerpo">
        <img src="<?php echo logo; ?>" />
		<br />
		<?php if($totix->user('id') != 0) { ?>
		<?php if($totix->user('rank') >= hkmin) { ?><a href="<?php echo www . panel; ?>" class="btn btn-primary" style="margin-top: 12px;"><span class="glyphicon glyphicon-star"></span> Administración </a><?php } ?>
		<a href="<?php echo www; ?>/logout" class="btn btn-danger" style="margin-top: 12px;"><span class="glyphicon glyphicon-remove"></span> Cerrar sesión </a>
		<a href="/client" target="_blank" class="btn btn-success" style="margin-top: 12px;"><span class="glyphicon glyphicon-play"></span> Entrar a <?php echo name; ?> &raquo; </a>
		<?php } ?>
		<div class="onlines">
			<?php echo $totix->onlines(); ?>
		</div>
    </div>
</div>

<nav class="navbar navbar-default navbar-fixed-top navbar-toggleable-md" role="navigation">
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
	<div class="hidden-sm hidden-md hidden-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navres" aria-controls="navres" aria-expanded="false" aria-label="Toggle navigation">
            <span class="glyphicon glyphicon-chevron-down"></span>
         </button>
    </div>
  <div class="collapse navbar-collapse navi" id="navres">
    <ul class="nav navbar-nav navbar-left">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo avatar . $totix->user('look'); ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /> Inicio <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo www; ?>/me"><span class="glyphicon glyphicon-hand-right"></span> <?php echo $totix->user('username'); ?></a></li>
          <li><a href="<?php echo www; ?>/home/<?php echo $totix->user('username'); ?>"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
          <li><a href="<?php echo www; ?>/settings/personales"><span class="glyphicon glyphicon-wrench"></span> Ajustes</a></li>
        </ul>
      </li>
	  <li><a href="<?php echo www; ?>/community"><span class="glyphicon glyphicon-globe"></span> Comunidad</a></li>
	  <li><a href="<?php echo www; ?>/photos"><span class="glyphicon glyphicon-camera"></span> Fotos</a></li>
	  <li><a href="<?php echo www; ?>/shop"><span class="glyphicon glyphicon-shopping-cart"></span> Tienda</a></li>
    </ul>
	
	<form class="navbar-form" action="" method="POST" name="search_form" id="search_form">
		<div class="form-group">
            <input type="text" class="form-control" name="search" id="search" placeholder="Buscar a un usuario..." autocomplete="off" />
        </div>
		<div id="resultado"><!--EL RESULTADO ESTA EN BUSCADORDEUSUARIOS.PHP--></div>
    </form>
	
  </div>
</nav>
<div class="line"></div>

<?php if(isset($page) && !empty($page)) { ?>
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo www; ?>/community">Comunidad</a></li>
        <li class="breadcrumb-item"><a href="<?php echo www; ?>/news">Noticias</a></li>
        <li class="breadcrumb-item"><a href="<?php echo www; ?>/team">Equipo administrativo</a></li>
    </ol>
</div>
<?php } ?>

