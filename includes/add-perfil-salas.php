<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="icono verde glyphicon glyphicon-home"></span> Salas de <?php echo $perfil['username']; ?></h3>
    </div>
	<div class="panel-body">
	  <div class="scroll">
	    <table class="table table-striped">
		<?php 
		$rooms = $db->query("SELECT * FROM rooms WHERE owner = '".$perfil['id']."' ORDER BY users_now DESC");
		if($rooms->num_rows == 0) {
			echo '<b>Este usuario no ha creado ninguna sala aún</b>';
		}
            while($room = $rooms->fetch_assoc())
			{
				if ($room['state'] == "open") {
					$state = "; display: none;";
				} elseif ($room['state'] == "locked") {
					$state = "20px -45px";
				} elseif ($room['state'] == "password") {
					$state = "20px -61px";
				}
				if($room['group_id'] > 0) {
					$group = "<div class='group-icon'></div>";
				} else {
					$group = "";
				}
				
				if ($room['users_now'] == 0) {
				    $usersnow = "1";
			    } elseif ($room['users_now'] >= $room['users_max']-2) {
				    $usersnow = "4";
			    } elseif ($room['users_now'] >= $room['users_max']/2) {
			    	$usersnow = "3";
			    } elseif ($room['users_now'] > 0) {
				    $usersnow = "2";
		    	} 
				
				$sql_owner = $db->query("SELECT * FROM users WHERE id = '" . $room['owner'] ."'");
				$owner = $sql_owner->fetch_assoc();
		?>
        <tr>
		    <td><img src="<?php echo www . '/app/images/room_icon_'.$usersnow.'.gif'; ?>" /> <b><?php echo $totix->filtro($room['caption']); ?></b> <br /> <i><?php echo $owner['username']; ?></i> &raquo; <u><?php echo $room['users_now']; ?> usuarios</u> <div id="stateroom" style="background-position: <?php echo $state; ?>"></div><?php echo $group; ?></td>
		</tr>
		<?php } ?>
		</table>
	  </div>
	</div>
</div>	