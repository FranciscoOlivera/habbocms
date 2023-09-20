<?php
/* #################################################################### \
||                                                                     ||
|| TotixCMS v5 - El uso de este software es privado y único            *#
|| # Copyright (C) 2016 @Author: Francisco Olivera <Totix>             *#
||---------------------------------------------------------------------*#
||---------------------------------------------------------------------*#
|| Script pensado para la gestión de retroservers Habbo.               *#
|| Tanto el script como los autores del mismo no tienen ningún tipo    *#
|| de asociación con Habbo y/o Sulake Oy Corp. Por lo tanto, estos no  *#
|| se hacen responsables del uso que el usuario le dé.                 *#
||                                                                     ||
\ #################################################################### */

require_once '../../engine/funciones.php';
$totix->checklogged('no');	
$totix->banned();

if(isset($_POST['buy_badge'])) {
	
	$sqlbadge = $db->query("SELECT * FROM cms_badges WHERE badge_id = '".$_POST['buy_badge']."' LIMIT 1");
	$sqlcheckbadge = $db->query("SELECT * FROM user_badges WHERE badge_id = '".$_POST['buy_badge']."' AND user_id = '".$totix->user('id')."' LIMIT 1");
	if($sqlbadge->num_rows > 0) {
		
		if($sqlcheckbadge->num_rows == 0) {
		
		    $placa = $sqlbadge->fetch_assoc();
		    if($totix->user('vip_points') >= $placa['cost']) {
				
			    $db->query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('".$totix->user('id')."', '".$totix->filtro($placa['badge_id'])."', '0')");
				$db->query("UPDATE users SET vip_points = vip_points - '".$totix->filtro($placa['cost'])."' WHERE id = '".$totix->user('id')."' LIMIT 1");
				$_SESSION['resultado_b_voucher'] = 'Has comprado la placa exitosamente, sí estas en el cliente, reinicia y checa inventario';
				header("Location: ".www."/shop");
				exit;
		    } else {
				$_SESSION['voucher_error'] = 'No tienes suficientes diamantes para comprar esta placa';
				header("Location: ".www."/shop");
				exit;
			}
		} else {
			$_SESSION['voucher_error'] = 'Ya tienes esta placa';
			header("Location: ".www."/shop");
			exit;
		}
	} else {
		$_SESSION['voucher_error'] = 'Esta placa no esta a la venta';
		header("Location: ".www."/shop");
		exit;
	}
	
} else {
	header("Location: ".www."");
}
?>