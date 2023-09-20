<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Usuarios al azar</h3>
    </div>
	<div class="panel-body">
	<?php
	$sql_rand = $db->query("SELECT id, username, look FROM users ORDER BY RAND() LIMIT 27");
	while($azar = $sql_rand->fetch_assoc()) {
	?>    
            <a  href="<?php echo www; ?>/home/<?php echo $azar['username']; ?>">
                <img class="tiptip" title="<?php echo $azar['username']; ?>" src="<?php echo avatar . $azar['look']; ?>&direction=3&head_direction=3&gesture=sml&size=b&img_format=gif&headonly=1" />
            </a>	
	<?php } ?>
	</div>
</div>	