<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $rank['name']; ?> <span style="float: right;" class="badge"><?php echo $rank['title']; ?></span></h3>
    </div>
	<div class="panel-body">
	<?php
    $users = $db->query("SELECT * FROM users WHERE rank = '". $rank['id'] ."' AND rank <= '16'");
    if($users->num_rows == 0) { 
    echo '<b><center>No hay '. $rank['name'] .' aún.</center></b>'; 
    }
    while($staffs = $users->fetch_assoc())
    {
    ?>
	<div class="staffuser" style="background: url('<?php echo $staffs['portada'] . '?' . rand(0,999999); ?>'); background-position: center; background-size: 100%;">
	    <div class="col-xs-2">
	        <img class="avatar img-circle" src="<?php echo avatar . $staffs['look']; ?>&size=l&gesture=sml&head_direction=3&headonly=1" />
		</div>
		<div class="col-xs-10">
		    <div class="infostaff">
			    <div class="col-xs-4">
			        <span class="name"><?php echo $staffs['username'] . $totix->verificado($staffs['rank']); ?></span>
				    <br />
				    <span class="label label-primary"><?php echo $staffs['motto']; ?></span>
					<br />
				    <span class="label label-success">
					<?php 
					if($staffs['online'] == '1')
					{
						echo 'Conectad@';
					}
					else
					{
						echo 'Última vez: '.$totix->getlast($staffs['last_online']); 
					}
					?>
					</span>
				</div>
				<div class="col-xs-4">
			        <?php
                        $get = $db->query("SELECT * FROM user_badges WHERE user_id = '".$staffs['id']."' ORDER BY badge_slot DESC LIMIT 4");
                        while($badges = $get->fetch_assoc())
                        {
                            echo '<img style="margin-top: 5px; margin-left: 20px;" src="'.badges.$badges['badge_id'].'.gif" >';   
                        }
						
						if(empty($staffs['fb']))
						{
							$fb = 'http://fb.com/OnPixels.us';
						}
						else
						{
							$fb = $staffs['fb'];
						}
                    ?>
				</div>
				<div class="col-xs-4">
                    <div class="list-group" style="margin-top: 12px;">
                        <a href="<?php echo www; ?>/home/<?php echo $staffs['username']; ?>" class="list-group-item"><span class="glyphicon glyphicon-user"></span> Ver perfil</a>
                        <a href="<?php echo $fb; ?>" target="_blank"class="list-group-item active"><span class="glyphicon glyphicon-share"></span> Facebook</a>
                    </div>
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>
    </div>
</div>