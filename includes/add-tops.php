<div class="col-xs-4">    
	<div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Top créditos</h3>
        </div>
	    <div class="panel-body">
		<?php
		$sql_top = $db->query("SELECT * FROM users ORDER BY credits DESC LIMIT 6");
		
		while($top = $sql_top->fetch_assoc())
		{
		?>	
		<div class="well well-sm">
            <a href="<?php echo www; ?>/home/<?php echo $top['username']; ?>"><img src="<?php echo avatar . $top['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" /><?php echo $top['username'] . $totix->verificado($top['rank']); ?></a> <span class="label label-primary"><?php echo $top['motto']; ?></span> <span class="label label-warning"><?php echo $top['credits']; ?> créditos</span>
        </div>		
		<?php	
		}
		unset($top); unset($sql_top);
		?>
	    </div>
    </div>	
</div>
<div class="col-xs-4">    
	<div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Top duckets</h3>
        </div>
	    <div class="panel-body">
		<?php
		$sql_top = $db->query("SELECT * FROM users ORDER BY activity_points DESC LIMIT 6");
		
		while($top = $sql_top->fetch_assoc())
		{
		?>	
		<div class="well well-sm">
            <a href="<?php echo www; ?>/home/<?php echo $top['username']; ?>"><img src="<?php echo avatar . $top['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" /><?php echo $top['username'] . $totix->verificado($top['rank']); ?></a> <span class="label label-primary"><?php echo $top['motto']; ?></span> <span class="label label-info"><?php echo $top['activity_points']; ?> duckets</span>
        </div>		
		<?php	
		}
		unset($top); unset($sql_top);
		?>
	    </div>
    </div>	
</div>	
<div class="col-xs-4">    
	<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Top diamantes</h3>
        </div>
	    <div class="panel-body">
		<?php
		$sql_top = $db->query("SELECT * FROM users ORDER BY vip_points DESC LIMIT 6");
		
		while($top = $sql_top->fetch_assoc())
		{
		?>	
		<div class="well well-sm">
            <a href="<?php echo www; ?>/home/<?php echo $top['username']; ?>"><img src="<?php echo avatar . $top['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" /><?php echo $top['username'] . $totix->verificado($top['rank']); ?></a> <span class="label label-primary"><?php echo $top['motto']; ?></span> <span class="label label-primary"><?php echo $top['vip_points']; ?> diamantes</span>
        </div>		
		<?php	
		}
		unset($top); unset($sql_top);
		?>
	    </div>
    </div>	
</div>		