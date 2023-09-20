<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="icono amarillo glyphicon glyphicon-tag"></span> Placas de <?php echo $perfil['username']; ?></h3>
    </div>
	<div class="panel-body">
	    <div class="scroll">
		    <?php
            $get = $db->query("SELECT * FROM user_badges WHERE user_id = '".$perfil['id']."' LIMIT 50");
			if($get->num_rows < 1)
			{
				echo '<b>Este usuario no tiene placas aún</b>';
			}
            while($badges = $get->fetch_array())
            {
                echo '<img style="margin-left: 5px;" src="'.badges.$badges['badge_id'].'.gif" />';   
            }
            ?>
		</div>
	</div>
</div>	