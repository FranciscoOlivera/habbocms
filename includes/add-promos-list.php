<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="icono amarillo glyphicon glyphicon-list-alt"></span> Noticias</h3>
    </div>
    <ul class="list-group">
    <?php
	$sql_lista = $db->query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 4");
	while($lista = $sql_lista->fetch_assoc()) {
	?>
    <a href="<?php echo www; ?>/news/<?php echo $lista['id']; ?>" class="list-group-item">
	    <h4 class="list-group-item-heading"><?php echo $lista['title']; ?></h4>
        <p class="list-group-item-text"><?php echo $lista['shortstory']; ?> - <i><?php echo date('d/m/Y', $lista['date']); ?></i> &raquo; </p>
	</a>
	<?php } ?>
    </ul>
</div>