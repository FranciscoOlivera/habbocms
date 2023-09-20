<div class="panel panel-default">
    <div id="comentarios"></div>
    <div class="panel-heading">
        <h3 class="panel-title">Deja tu comentario</h3>
    </div>
	<div class="panel-body">
	    <form action="<?php echo www; ?>/app/submits/comment_submit.php" method="POST">
	        <div class="input-group">
                <input type="text" name="comentario" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-success" type="submit">Dejar comentario</button>
                </span>
            </div>
		</form>
		<hr />
		<?php if(isset($_SESSION['comment_error'])) { echo '<div class="alert alert-danger">'.$_SESSION['comment_error'].'</div>'; } ?>
		<div class="scroll">
	        <table class="table table-striped">
		    <?php
		    $sql_comments = $db->query("SELECT * FROM cms_comments_news WHERE notice_id = '".$id."' ORDER BY id DESC");
		
		    if($sql_comments->num_rows < 1)
		    {
			    echo '<div class="alert alert-danger">No hay comentarios en esta noticia aún, se el primero</div>';
		    }
		
		    while($comentario = $sql_comments->fetch_assoc()) {
			    $sql_user_comment = $db->query("SELECT id, username, look, rank FROM users WHERE id = '".$comentario['added_by']."' LIMIT 1");
			    $userc = $sql_user_comment->fetch_assoc();
		    ?>
	            <tr>
	                <td>
	                    <div class="col-xs-1">
		                    <img src="<?php echo avatar . $userc['look']; ?>&direction=3&head_direction=3&gesture=sml&size=b&img_format=gif&headonly=1" />
		                </div>
					    <div class="col-xs-<?php if($totix->user('id') != $comentario['added_by']) { echo '11'; } else { echo '9'; } ?>">
                            <p><?php echo $comentario['comentario']; ?></p>
                            <small><cite title="<?php echo $userc['username']; ?>"><a href="<?php echo www; ?>/home/<?php echo $userc['username']; ?>"><?php echo $userc['username'] . $totix->verificado($userc['rank']); ?></a> - <?php echo $comentario['added_date']; ?></cite></small>
					    </div>
					    <?php if($totix->user('id') == $comentario['added_by']) { ?>
					    <div class="col-xs-2">
					        <form action="<?php echo www; ?>/app/submits/comment_submit.php" method="POST">
					            <button type="submit" name="delete" class="btn btn-danger" value="<?php echo $comentario['id']; ?>">
                                    <span class="glyphicon glyphicon-remove"></span> Eliminar
                                </button>
					        </form>
					    </div>
					    <?php } ?>
	                </td>
	            </tr>
		    <?php } ?>
	        </table>
		</div>
	</div>
</div>	