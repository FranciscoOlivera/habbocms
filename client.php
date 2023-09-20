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

require_once 'engine/funciones.php';
$totix->checklogged('no');
$totix->banned();

$ticket = 'TOTIX-550-'.md5(rand(10000,99999)).'-118';

$db->query("UPDATE users SET auth_ticket = '', auth_ticket = '".$ticket."', ip_last = '', ip_last = '".$totix->ip()."' WHERE id = '".$totix->user('id')."'") or die('Hubo un error inesperado');
	
$ticketsql = $db->query("SELECT * FROM users WHERE id = '".$totix->user('id')."'") or die('Hubo un error inesperado');
$ticketrow = $ticketsql->fetch_assoc();
?>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="<?php echo www; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<title><?php echo name; ?> &raquo; Jugar</title>
		<script src="<?php echo www; ?>/clientjs/jquery-latest.js" type="text/javascript"></script>
		<script src="<?php echo www; ?>/clientjs/jquery-ui.js" type="text/javascript"></script>
		<script src="<?php echo www; ?>/clientjs/flashclient.js"></script>
		<script src="<?php echo www; ?>/clientjs/flash_detect_min.js"></script>
		<script src="<?php echo www; ?>/clientjs/client.js" type="text/javascript"></script>
		<style type="text/css">

			*, body {
				margin: 0;
				padding: 0;
				font: initial;
			}

		</style>
	</head>
	<body>
		<div id="client-ui">
			<div id="client" style='position:absolute; left:0; right:0; top:0; bottom:0; overflow:hidden; height:100%; width:100%;background: #000;'></div>
		</div>
		<script>
			var Client = new SWFObject("<?php echo $datos->cliente('flash_client_url') . $datos->cliente('habbo_swf'); ?>", "client", "100%", "100%", "10.0.0");
			Client.addVariable("client.allow.cross.domain", "1");
			Client.addVariable("client.notify.cross.domain", "0");
			Client.addVariable("connection.info.host", "<?php echo $datos->cliente('host'); ?>");
			Client.addVariable("connection.info.port", "<?php echo $datos->cliente('port'); ?>");
			Client.addVariable("site.url", "<?php echo www; ?>");
			Client.addVariable("url.prefix", "<?php echo www; ?>");
			Client.addVariable("client.reload.url", "<?php echo www; ?>/client");
			Client.addVariable("client.fatal.error.url", "<?php echo www; ?>/client");
			Client.addVariable("client.connection.failed.url", "<?php echo www; ?>/client");
			Client.addVariable("logout.url", "<?php echo www; ?>/client");
			Client.addVariable("logout.disconnect.url", "<?php echo www; ?>/client");
			Client.addVariable("external.variables.txt", "<?php echo $datos->cliente('external_variables'); ?>");
			Client.addVariable("external.texts.txt", "<?php echo $datos->cliente('external_flash_texts'); ?>");
			Client.addVariable("external.override.variables.txt", "<?php echo $datos->cliente('ext_ov_var'); ?>");
			Client.addVariable("external.override.texts.txt", "<?php echo $datos->cliente('ext_ov_txt'); ?>");
			Client.addVariable("productdata.load.url", "<?php echo $datos->cliente('productdata'); ?>");
			Client.addVariable("furnidata.load.url", "<?php echo $datos->cliente('furnidata'); ?>");
			Client.addVariable("external.figurepartlist.txt", "<?php echo $datos->cliente('figuredata'); ?>");
			Client.addVariable("flash.dynamic.avatar.download.configuration", "<?php echo $datos->cliente('figuremap'); ?>");
			Client.addVariable("use.sso.ticket", "1");
			Client.addVariable("sso.ticket", "<?php echo $ticketrow['auth_ticket']; ?>");
			Client.addVariable("account_id", "<?php echo $totix->user('id'); ?>");
			Client.addVariable("processlog.enabled", "1");
			Client.addVariable("client.starting", "<?php echo name; ?> está cargando...");
			//Client.addVariable("client.starting.revolving", "Para ciencia, \u00A1T\u00FA, monstruito!\/Cargando mensajes divertidos... Por favor, espera.\/\u00BFTe apetecen salchipapas con qu\u00E9?\/Sigue al pato amarillo.\/El tiempo es s\u00F3lo una ilusi\u00F3n.\/\u00A1\u00BFTodav\u00EDa estamos aqu\u00ED?!\/Me gusta tu camiseta.\/Mira a la izquierda. Mira a la derecha. Parpadea dos veces. \u00A1Ta-ch\u00E1n!\/No eres t\u00FA, soy yo.\/Shhh! Estoy intentando pensar.\/Cargando el universo de p\u00EDxeles.");//
			<?php if($room) { ?>Client.addVariable("forward.id", "<?php echo $room; ?>");<?php } ?>
			Client.addVariable("flash.client.url", "<?php echo $datos->cliente('flash_client_url'); ?>");
			Client.addVariable("flash.client.origin", "popup");
			Client.addVariable("nux.lobbies.enabled", "true");
			Client.addParam('base', '<?php echo $datos->cliente('flash_client_url'); ?>');
			Client.addParam('allowScriptAccess', 'always');
			Client.addParam('menu', false);
			Client.addParam('wmode', "opaque");
			Client.write('client');
			FlashExternalInterface.signoutUrl = "<?php echo www; ?>/logout";
		</script>
		
		<script>if(!FlashDetect.installed){window.location.href = "<?php echo www; ?>/noflash";}</script>
	</body>
<body id="client" class="flashclient">

</body>
</html>