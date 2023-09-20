<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Placas en venta</h3>
    </div>
	<div class="panel-body">
	    <?php
		$sql_badges = $db->query("SELECT * FROM cms_badges ORDER BY id DESC LIMIT 10");
		while($badge = $sql_badges->fetch_assoc()) {
		?>
	    <div class="well well-sm">
		    <img src="<?php echo badges . $badge['badge_id'] ?>.gif" />
			<span class="label label-warning"><?php echo $badge['description']; ?></span>
			<div style="float: right;">
			    <form action="<?php echo www;?>/app/submits/tienda_submit.php" method="POST">
			    <img src="<?php echo www; ?>/app/images/icons/diamond.png" /><b> x <?php echo $badge['cost']; ?></b> 
				<?php
				$sql_check_b = $db->query("SELECT * FROM user_badges WHERE user_id = '".$totix->user('id')."' AND badge_id = '".$badge['badge_id']."' LIMIT 1");
				if($sql_check_b->num_rows > 0) {
				?>
				    <button type="button" name="placa" class="btn btn-success" disabled>¡Placa comprada!</button>
			    <?php
		        } elseif($totix->user('vip_points') >= $badge['cost']) {
				?>
					<button type="submit" value="<?php echo $badge['badge_id']; ?>" name="buy_badge" class="btn btn-primary">Comprar placa &raquo;</button>
				<?php } else { ?>
				    <button type="button" name="placa" class="btn btn-danger" disabled>No tienes suficientes diamantes :(</button>
				<?php } ?>
				</form>	
		    </div>
		</div>
		<?php } ?>
	</div>
</div>	