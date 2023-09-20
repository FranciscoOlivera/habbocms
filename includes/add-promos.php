<?php
$sql_news = $db->query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 1");
$noticia = $sql_news->fetch_assoc();
?>
<div class="panel panel-default promos" style="background-image: url('<?php echo $noticia['image']; ?>'); background-position: 0px 0; color: #fff; height: 300px;">
    <div class="panel-body">
	    <h1 style="color: #fff;"><?php echo $noticia['title']; ?></h1>
        <p>
		    <?php echo $noticia['shortstory']; ?>
		    <a href="<?php echo www; ?>/news/<?php echo $noticia['id']; ?>" class="btn btn-primary" style="float: right;">Leer más</a>
		</p>
    </div>
</div>