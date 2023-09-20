<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="icono rojo glyphicon glyphicon-heart"></span> Amigos de <?php echo $perfil['username']; ?></h3>
    </div>
	<div class="panel-body">
	    <div class="scroll">
		    <?php
            $query = $db->query("SELECT * FROM messenger_friendships WHERE user_one_id = '". $perfil['id'] ."' OR user_two_id = '". $perfil['id']."' ORDER BY id DESC");
			if($query->num_rows < 1)
			{
				echo '<b>Este usuario no tiene amigos aún</b>';
			}
            while($friends = $query->fetch_assoc())
            {
				if($friends['user_one_id'] == $perfil['id'])
				{
					$friendv = $friends['user_two_id'];
				}
				elseif($friends['user_two_id'] == $perfil['id'])
				{
					$friendv = $friends['user_one_id'];
				}
									
                $getfriend = $db->query("SELECT * FROM users WHERE id = '".$friendv."'");
                $friend = $getfriend->fetch_assoc();
            ?>
	        <div class="col-xs-6">
	            <div class="well well-sm">
				    <a href="<?php echo www; ?>/home/<?php echo $friend['username']; ?>">
                        <img src="<?php echo avatar . $friend['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" /><font style="margin-left: 10px;"><?php echo $friend['username']; ?></font>
                    </a>
				</div>
		    </div>
			<?php } ?>
		</div>	
	</div>
</div>	