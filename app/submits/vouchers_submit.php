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

if(isset($_POST['canj'])) {
	
	if(!empty($_POST['voucher'])) {
		
		$sql_check_voucher = $db->query("SELECT * FROM vouchers WHERE voucher = '".$totix->filtro($_POST['voucher'])."'");
		if($sql_check_voucher->num_rows > 0) {
			$voucher = $sql_check_voucher->fetch_assoc();
			
			if($voucher['canjed'] == '0') {
				
				if($voucher['vip'] == '1') {
					$db->query("INSERT INTO user_badges (user_id, badge_id, bagde_slot) VALUES ('".$totix->user('id')."', 'VIP', '0')");
					$_SESSION['vip'] = ' y <b>VIP</b>';
				}	
				$db->query("UPDATE users SET vip_points = vip_points + '".$voucher['vip_points']."', vip = '".$voucher['vip']."' WHERE id = '". $totix->user('id') ."' LIMIT 1");
				$db->query("UPDATE vouchers SET canjed = '1' WHERE voucher = '". $voucher['voucher'] ."' LIMIT 1");
				$_SESSION['vip_points'] = $voucher['vip_points'];
				$_SESSION['resultado_b_voucher'] = '¡Has canjeado el código por <b>'.$_SESSION['vip_points'].'</b> diamantes'.$_SESSION['vip'].'!';
				header("Location: ".www."/shop");
		        exit;
				
			} else {
				$_SESSION['voucher_error'] = 'Este código voucher ya ha sido canjeado';
		        header("Location: ".www."/shop");
		        exit;
			}
			
		} else {
			$_SESSION['voucher_error'] = 'Este código voucher no existe';
		    header("Location: ".www."/shop");
		    exit;
		}
		
	} else {
		$_SESSION['voucher_error'] = 'No dejes el espacio en blanco';
		header("Location: ".www."/shop");
		exit;
	}
} elseif(isset($_POST['buy_voucher'])) {
	
	$_SESSION['voucher'] = $totix->voucher();
	
	$costo_voucher = 10000;
	
	if($totix->user('credits') >= $costo_voucher) {
		$db->query("INSERT INTO vouchers (voucher, vip_points, vip, canjed, added_by, added_date) VALUES ('".$_SESSION['voucher']."', '10000', '1', '0', '".$totix->user('id')."', '".$totix->fecha('normal')."')");
		$db->query("UPDATE users SET credits = credits - '".$costo_voucher."' WHERE id = '".$totix->user('id')."' LIMIT 1");
		$_SESSION['resultado_b_voucher'] = 'Has comprado un <b>voucher</b> exitosamente, te aparecera en el apartado "mis códigos voucher"';
		header("Location: ".www."/shop");
		exit;
	} else {
		$_SESSION['voucher_error'] = 'No tienes suficientes créditos para comprar un código voucher';
		header("Location: ".www."/shop");
		exit;
	}
	
} else {
	header("Location: ".www."/shop");
}
?>