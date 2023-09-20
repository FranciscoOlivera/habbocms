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

require_once '../engine/funciones.php';
unset($_SESSION['hk_loged']);
$db->query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Logeo', '".$totix->user('username')." salio del panel', '". $totix->user('rank') ."', '". $totix->user('id') ."', '". time() ."')");
header("Location: ". www ."");

?>