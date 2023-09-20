<?php
$ultimaa = $db->query("SELECT id FROM cms_news ORDER BY id DESC LIMIT 1");
$ultima = $ultimaa->fetch_assoc();
if(empty($id) || !isset($id))
{
	$id = $ultima['id'];
}
	$sql_noticia = $db->query("SELECT * FROM cms_news WHERE id = '".$id."' LIMIT 1");
	$noticia = $sql_noticia->fetch_assoc();
	
	$sql_check_like = $db->query("SELECT * FROM cms_news_likes WHERE notice_id = '". $noticia['id'] ."' AND added_by_id = '". $totix->user('id') ."' LIMIT 1");
	if($sql_check_like->num_rows > 0) 
	{
		$button = '
		<button type="submit" name="like" class="btn btn-danger" value="dislike">
           <span class="glyphicon glyphicon-thumbs-down"></span> Ya no me gusta
        </button>';
	}
    else
	{
		$button = '
		<button type="submit" name="like" class="btn btn-success" value="'.$noticia['id'].'">
           <span class="glyphicon glyphicon-thumbs-up"></span> Me gusta
        </button>';
	}		
	
	if($sql_noticia->num_rows < 1) 
	{
		echo '<div class="alert alert-danger">La noticia que solicitas no existe</div>';
	}
	else
	{
		
		$sql_loslikes = $db->query("SELECT * FROM cms_news_likes WHERE notice_id = '". $noticia['id'] ."'");
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $noticia['title']; ?> - <?php echo $totix->getlast($noticia['date']); ?></h3>
    </div>
    <div class="panel-body">
		<?php echo $noticia['longstory']; ?>
		<hr />
		<div class="col-xs-8">
		    <form action="<?php echo www; ?>/app/submits/like_submit.php" method="POST">
		        <div class="btn-group">
			        <?php echo $button; ?>
					<a href="<?php echo www; ?>/home/<?php echo $noticia['author']; ?>" type="button" class="btn btn-warning"><?php echo $noticia['author']; ?></a>
				    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-bell"></span> A <b><?php echo $sql_loslikes->num_rows; ?></b> keko(s) le(s) gusta esto</button>				    
                </div>
		    </form>		
		    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
	                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
	                        <h4 class="modal-title" id="mySmallModalLabel">Gente a la que le gusta esto</h4> 
	                    </div>
	                    <div class="modal-body">
						<?php
						if($sql_loslikes->num_rows < 1) { 
						    echo 'Nadie le ha dado "Me gusta" a esta noticia, se el primero';
						}
						while($usuarios = $sql_loslikes->fetch_assoc()) {
							$userrl = $db->query("SELECT id, username, look FROM users WHERE id = '". $usuarios['added_by_id'] ."' ORDER BY id DESC");
							$userl = $userrl->fetch_assoc();
						?>
						<a href="<?php echo www . '/home/' . $userl['username']; ?>">
							<img src="<?php echo avatar . $userl['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" style="float: left;" /> <u><?php echo $userl['username']; ?></u>
							</a>
						<hr />
						<?php } ?>
						</div>
	                </div>
                </div>
            </div>
		</div>
    </div>
</div>
<?php } ?>

