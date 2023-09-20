<div class="list-group">
    <?php
	$sql_rangos = $db->query("SELECT * FROM ranks WHERE id >= '".minrank."' AND id <= '16' ORDER BY id DESC");
	while($rango = $sql_rangos->fetch_assoc()) {
		$how = $db->query("SELECT * FROM users WHERE rank = '".$rango['id']."'");
		
		if(empty($id_r) || !isset($id_r))
        {
        	$id_r = $rango['id'];
        }
		
		if($id_r != $rango['id'])
		{
			$activo = '';
		}
		else
		{
			$activo = 'active';
		}
	?>
    <a href="<?php echo www . '/team/' . $rango['id']; ?>" class="list-group-item <?php echo $activo; ?>">
        <?php echo $rango['name']; ?><span class="badge"><?php echo $how->num_rows; ?></span>
    </a>
	<?php } ?>
</div>