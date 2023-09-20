<div class="list-group">
	<?php
	
    $active = $totix->filtro($_GET['id']);
	
    $sql_lista = $db->query("SELECT * FROM cms_news ORDER BY id DESC");
	$listaaa = $db->query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 1");
    $lista_a = $listaaa->fetch_assoc();
	while($lista = $sql_lista->fetch_assoc()) {
		
		$likess = $db->query("SELECT * FROM cms_news_likes WHERE notice_id = '". $lista['id'] ."'");
		$likes = $likess->num_rows;
		$comentarioss = $db->query("SELECT * FROM cms_comments_news WHERE notice_id = '". $lista['id'] ."'");
		$comentarios = $comentarioss->num_rows;
		
		if(empty($active) || !isset($active))
        {
        	$active = $lista_a['id'];
        }
		
		if($active != $lista['id'])
		{
			$activo = '';
		}
		else
		{
			$activo = 'active';
		}
	?>
		<a href="<?php echo www; ?>/news/<?php echo $lista['id']; ?>" class="list-group-item <?php echo $activo; ?>"><?php echo $lista['title']; ?> &raquo; <span class="badge"><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo $likes; ?> | <span class="glyphicon glyphicon-comment"></span> <?php echo $comentarios; ?></span></a></li>
	<?php } ?>
</div>
