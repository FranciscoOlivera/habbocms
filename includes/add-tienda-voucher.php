<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Códigos voucher</h3>
    </div>
	<div class="panel-body">
	    <form action="<?php echo www; ?>/app/submits/vouchers_submit.php" method="POST">
	        <div class="input-group">
                <input type="text" name="voucher" class="form-control" placeholder="Introduce código">
                <span class="input-group-btn">
                    <button class="btn btn-info" name="canj" type="submit">Canjear</button>
                </span>
            </div>
	    </form>
		<hr />
	    <form action="<?php echo www; ?>/app/submits/vouchers_submit.php" method="POST">
		    <button type="submit" name="buy_voucher" class="btn btn-warning btn-block">Comprar código (10,000 créditos)</button>
		</form>
		<span class="help-block">Un código voucher puedes comprarlo o ganartelo en concursos del hotel, al momento de canjearlos tienes la opción de pasarselo a un amigo o de canjearlo tú mismo, ganaras <b>VIP</b> y <b>10,000</b> diamantes.</span>
		<hr />
		<h3>Mis códigos voucher</h3>
		<?php 
		$sqlvouchercod = $db->query("SELECT * FROM vouchers WHERE canjed = '0' AND added_by = '".$totix->user('id')."' ORDER BY id DESC");
		if($sqlvouchercod->num_rows < 1) {
			echo '¡No tienes códigos voucher aún, compra unos!';
    	} else {
		?>
		<table class="table table-striped">
		    <tr>
			    <td><b>Código</b></td>
				<td><b>Incluye</b></td>
			<tr>
			<?php 
			while($cod = $sqlvouchercod->fetch_assoc()) {
				if($cod['vip'] == '1' && $cod['vip_points'] > 0) {
					$incluye = 'VIP y diamantes';
				} elseif($cod['vip'] == '0' && $cod['vip_points'] > 0) {
					$incluye = 'Diamantes';
				} elseif($cod['vip'] == '1' && $cod['vip_points'] == 0) {
					$incluye = 'Solo VIP';
				}
			?>
			<tr>
			    <td><?php echo $cod['voucher']; ?></td>
				<td><?php echo $incluye; ?></td>
			</tr>	
		<?php } } ?>
        </table>
	</div>
</div>	