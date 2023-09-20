<?php

require_once("../../engine/funciones.php");

if(isset($_POST['search'])) {
	$search = $totix->filtro($_POST['search']);
}
$consulta = $db->query("SELECT * FROM users WHERE username LIKE '%". $search ."%' ORDER BY id ASC LIMIT 5");
$fila = $consulta->fetch_assoc();
$total = $consulta->num_rows;

if($total > 0 && $search !='') {
?>
<div class="buscador">
<?php	
do {
?> 
    <a type="button" class="btn btn-success btn-lg btn-block" href="<?php echo www; ?>/home/<?php echo $fila['username']; ?>">
        <div class="text-left"><img src="<?php echo avatar . $fila['look']; ?>&direction=3&head_direction=3&gesture=sml&size=s&img_format=gif&headonly=1" /> <?php echo str_replace($search, '<strong>'. $search .'</strong>', utf8_encode($fila['username'])); ?></div>
	</a>
<?php
} while($fila = $consulta->fetch_assoc()); 
?>
</div>
<?php
} elseif(empty($search)) { 
echo ''; 
} else {
echo '<div class="well well-sm buscador">No se han encontrado resultados</div>';
}
?>	